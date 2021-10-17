<?php

namespace GlimeshClient\Builder;

use GlimeshClient\Traits\ObjectResolverTrait;

/**
 * Project builder class for building all Objects, interfaces, enums etc from
 * the Glimesh API
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Builder
{
    /**
     * Schema Array, as loaded from api.json in construct
     *
     * @var array
     */
    public $schema = [];

    /**
     * Paths config, where to place each object type
     *
     * @var array
     */
    public $paths = [
        'INTERFACE'     => 'src/GlimeshClient/Interfaces',
        'OBJECT'        => 'src/GlimeshClient/Objects',
        'INPUT_OBJECT'  => 'src/GlimeshClient/Objects/Input',
        'ENUM'          => 'src/GlimeshClient/Objects/Enums',
    ];

    /**
     * Standard DocBlock to place on every new class or interface
     *
     * @var array
     */
    public static $standardDocBlock = [
        ' * @author Adam Hebden <adam@adamhebden.com>',
        ' * @copyright 2021 Adam Hebden',
        ' * @license GPL-3.0-or-later',
        ' * @package GlimeshClient',
    ];

    /**
     * Hardcoded replacements, for things we don't want to implement
     *
     * @var array
     */
    public static $replaceObjects = [
        'NaiveDateTime' => '\DateTime',
        'DateTime' => '\DateTime',
        'ID' => 'string',
    ];

    /**
     * Constructor, loads the API JSON from path
     *
     * @param string $apiJsonFilePath
     */
    public function __construct(string $apiJsonFilePath)
    {
        $this->schema = json_decode(
            file_get_contents($apiJsonFilePath),
            true
        )['data']['__schema']['types'];
    }

    /**
     * Resolves a field into a Type, valid or not
     *
     * @throws \Exception When we cannot resolve the object
     *
     * @param array $field
     *
     * @return string
     */
    public static function resolveField(array $field): string
    {
        $fieldName = $field['name'];
        $typeName = isset($field['type']['name']) ? $field['type']['name'] : '';

        $resolvedType = ObjectResolverTrait::resolveObjectKey($fieldName);

        if ($resolvedType !== null) {
            $resolvedType = preg_replace('/(.*?)\\\([a-z]+)$/i', "$2", $resolvedType);
        }

        if ($resolvedType === null && isset($field['type']['ofType']['name'])) {
            $resolvedType = $field['type']['ofType']['name'];
        }

        if ($resolvedType === null) {
            if (in_array(strtolower($typeName), ['string', 'int', 'boolean'])) {
                $resolvedType = strtolower($typeName);
            }
        }

        if (isset(self::$replaceObjects[$resolvedType])) {
            $resolvedType = self::$replaceObjects[$resolvedType];
        }

        if (isset(self::$replaceObjects[$typeName])) {
            $resolvedType = self::$replaceObjects[$typeName];
        }

        if (isset($typeName) && $resolvedType === null) {
            if (class_exists("\\GlimeshClient\\Objects\\{$typeName}")) {
                return $typeName;
            }
        }

        if (isset($field['type']['kind']) && $field['type']['kind'] === 'LIST') {
            $resolvedType = "\ArrayObject<$resolvedType>";
        }

        if ($resolvedType == null) {
            throw new \Exception("Field $fieldName could not be resolved");
        }

        return $resolvedType;
    }

    /**
     * Builds a single Field DocBlock, after resolving the field
     *
     * Returns null if the field is Deprecated
     *
     * @param array $field
     *
     * @return string|null
     */
    public static function buildField(array $field): ?string
    {
        if (($field['isDeprecated'] ?? false) === true) {
            return null;
        }

        return self::replaceValues(
            __DIR__ . '/resources/field.php.txt',
            [
                '%BUILDER_FIELD_DESCRIPTION%' => $field['description'] ?? 'Description not provided',
                '%BUILDER_FIELD_TYPE%' => self::resolveField($field),
                '%BUILDER_FIELD_NAME%' => $field['name']
            ]
        );
    }

    public static function replaceValues(string $filename, array $replace): string
    {
        $code = file_get_contents($filename);

        return str_replace(array_keys($replace), array_values($replace), $code);
    }

    /**
     * Builds all fields from array using buildField
     *
     * @param array $fieldArray
     *
     * @return string
     */
    public static function buildFields(array $fieldArray): string
    {
        $code = (array_map(function ($field) {
            return self::buildField($field);
        }, $fieldArray));

        return rtrim(implode("\n", $code));
    }

    /**
     * Builds a single Object class string, including all fields
     *
     * @param array $type
     *
     * @return string
     */
    public static function buildObject(array $type): string
    {
        $fields = $type['fields'];

        $use = '';
        $interfaces = empty($type['interfaces']) ? null : ' implements ' . $type['interfaces'][0]['name'];
        if (!empty($interfaces)) {
            $use .= "\nuse GlimeshClient\Interfaces\\{$type['interfaces'][0]['name']};\n";
            $use .= "use GlimeshClient\Objects\AbstractObjectModel;\n";
        }

        return self::replaceValues(
            __DIR__ . '/resources/object.php.txt',
            [
                '%BUILDER_USE%' => $use,
                '%BUILDER_DESCRIPTION%' => $type['description'] ?? 'Description not provided',
                '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
                '%BUILDER_NAME%' => $type['name'],
                '%BUILDER_INTERFACES%' => $interfaces,
                '%BUILDER_FIELDS%' => self::buildFields($fields),
            ]
        );
    }

    /**
     * Builds a single Input Object class string, including all fields
     *
     * @param array $type
     *
     * @return string
     */
    public static function buildInputObject(array $type): string
    {
        return self::replaceValues(
            __DIR__ . '/resources/input_object.php.txt',
            [
                '%BUILDER_DESCRIPTION%' => $type['description'] ?? 'Description not provided',
                '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
                '%BUILDER_NAME%' => $type['name'],
                '%BUILDER_FIELDS%' => self::buildFields($type['inputFields']),
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
    public static function buildInterface(array $type): string
    {
        return self::replaceValues(
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
    public static function buildENUM(array $type): string
    {
        $possibleValues = array_map(function ($enum) {
            return "        \"{$enum['name']}\"";
        }, $type['enumValues'] ?? []);

        $fieldsCode = array_map(function ($enum) {
            return "    public const {$enum['name']} = \"{$enum['name']}\";";
        }, $type['enumValues'] ?? []);

        return self::replaceValues(
            __DIR__ . '/resources/enum.php.txt',
            [
                '%BUILDER_DESCRIPTION%' => $type['description'] ?? 'Description not provided',
                '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
                '%BUILDER_NAME%' => $type['name'],
                '%BUILDER_POSSIBLE_VALUES%' => implode(",\n", $possibleValues),
                '%BUILDER_FIELDS%' => implode("\n", $fieldsCode),
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
        $accepts = array_keys($this->paths);

        foreach ($this->schema as $type) {
            if (!in_array($type['kind'], $accepts) || substr($type['name'], 0, 2) === '__') {
                continue;
            }

            $code = null;
            $path = $this->paths[$type['kind']] ?? null;

            if (!empty($type['interfaces'])) {
                $path .= '/' . $type['interfaces'][0]['name'];
            }

            switch ($type['kind']) {
                case 'OBJECT':
                    $code = self::buildObject($type);
                    break;

                case 'INTERFACE':
                    $code = self::buildInterface($type);
                    break;

                case 'INPUT_OBJECT':
                    $code = self::buildInputObject($type);
                    break;

                case 'ENUM':
                    $code = self::buildENUM($type);
                    break;
            }


            if ($code !== null && $path !== null) {
                echo "$path/{$type['name']}.php \n";

                if (!file_exists($path)) {
                    mkdir($path);
                }

                file_put_contents(
                    "$path/{$type['name']}.php",
                    $code
                );
            }
        }
    }
}
