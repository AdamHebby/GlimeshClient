<?php

namespace GlimeshClient\Builder;

use GlimeshClient\Builder\CodeBuilders\AbstractBuilder;
use GlimeshClient\Builder\CodeBuilders\FieldBuilder;
use GlimeshClient\Builder\CodeBuilders\ObjectBuilder;
use GlimeshClient\Builder\CodeBuilders\UtilsBuilder;
use GlimeshClient\Builder\Resolver\ObjectResolver;
use GlimeshClient\Builder\Resolver\SchemaMappingResolver;

/**
 * Project builder class for building all Objects, interfaces, enums etc from
 * the Glimesh API
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Builder extends AbstractBuilder
{
    /**
     * Paths config, where to place each object type
     *
     * @var array
     */
    public array $paths = [
        'INTERFACE'     => 'src/GlimeshClient/Interfaces',
        'OBJECT'        => 'src/GlimeshClient/Objects',
        'INPUT_OBJECT'  => 'src/GlimeshClient/Objects/Input',
        'ENUM'          => 'src/GlimeshClient/Objects/Enums',
    ];

    private SchemaMappingResolver $resolver;
    private ObjectResolver $objectResolver;
    private FieldBuilder $fieldBuilder;
    private ObjectBuilder $objectBuilder;
    /**
     * Constructor, loads the API JSON from path
     *
     * @param string $apiJsonFilePath
     */
    public function __construct(string $apiJsonFilePath)
    {
        $schema = json_decode(
            file_get_contents($apiJsonFilePath),
            true
        )['data']['__schema']['types'];

        $this->resolver       = new SchemaMappingResolver($schema);
        $this->objectResolver = new ObjectResolver($this->resolver);
        $this->fieldBuilder   = new FieldBuilder($this->objectResolver, $this->resolver);
        $this->objectBuilder  = new ObjectBuilder($this->fieldBuilder);
    }

    /**
     * Builds a single Input Object class string, including all fields
     *
     * @param array $type
     *
     * @return string
     */
    public function buildInputObject(array $type): string
    {
        return self::templateValues(
            __DIR__ . '/resources/input_object.php.txt',
            [
                '%BUILDER_DESCRIPTION%' => $type['description'] ?? 'Description not provided',
                '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
                '%BUILDER_NAME%' => $type['name'],
                '%BUILDER_FIELDS%' => $this->fieldBuilder->buildFields($type['inputFields']),
            ]
        );
    }

    /**
     * Builds a single Interface string
     *
     * @param array $type
     *
     * @return string
     */
    public function buildInterface(array $type): string
    {
        return self::templateValues(
            __DIR__ . '/resources/interface.php.txt',
            [
                '%BUILDER_DESCRIPTION%' => $type['description'] ?? 'Description not provided',
                '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
                '%BUILDER_NAME%' => $type['name'],
            ]
        );
    }

    /**
     * Builds a single ENUM object string, including any static fields
     *
     * @param array $type
     *
     * @return string
     */
    public function buildENUM(array $type): string
    {
        $enumValues = array_map(function ($enum) {
            return "    case {$enum['name']} = \"{$enum['name']}\";";
        }, $type['enumValues'] ?? []);

        return self::templateValues(
            __DIR__ . '/resources/enum.php.txt',
            [
                '%BUILDER_DESCRIPTION%' => $type['description'] ?? 'Description not provided',
                '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
                '%BUILDER_NAME%' => $type['name'],
                '%BUILDER_ENUM_VALUES%' => implode("\n", $enumValues),
            ]
        );
    }

    /**
     * Builds the entire project, putting classes in their correct places
     *
     * @return void
     */
    public function build()
    {
        foreach ($this->resolver->getInterfaces() as $interface) {
            $code = $this->buildEnum($interface);
            $this->writeCode($code, $interface);
        }

        foreach ($this->resolver->getEnums() as $enum) {
            $code = $this->buildEnum($enum);
            $this->writeCode($code, $enum);
        }

        foreach ($this->resolver->getInputObjects() as $inputs) {
            $code = $this->buildEnum($inputs);
            $this->writeCode($code, $inputs);
        }

        foreach ($this->resolver->getObjects() as $object) {
            $code = $this->objectBuilder->buildObjectCode($object);
            $this->writeCode($code, $object);
        }

        file_put_contents(
            "src/GlimeshClient/Traits/FieldMappingTrait.php",
            (new UtilsBuilder($this->resolver))
                ->buildFieldMappingTrait()
        );
    }

    private function writeCode($code, $type): void
    {
        $path = $this->paths[$type['kind']] ?? null;
        if (!file_exists($path)) {
            mkdir($path);
        }

        // echo "$path/{$type['name']}.php" . "\n";
        // echo $code . "\n ---- \n";

        file_put_contents(
            "$path/{$type['name']}.php",
            $code
        );
    }
}
