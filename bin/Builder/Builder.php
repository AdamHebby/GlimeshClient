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
    public static $paths = [
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
     * Links for Documentation
     *
     * @todo Implement
     *
     * @var array
     */
    public static $links = [

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
            $reflect = new \ReflectionClass($resolvedType);
            $resolvedType = $reflect->getShortName();
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

        $fieldsCode = file_get_contents(__DIR__ . '/resources/field.php.txt');

        return str_replace(
            [
                '%BUILDER_FIELD_DESCRIPTION%',
                '%BUILDER_FIELD_TYPE%',
                '%BUILDER_FIELD_NAME%',
            ],
            [
                $field['description'] ?? 'Description not provided',
                self::resolveField($field),
                $field['name']
            ],
            $fieldsCode
        );
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

        $fieldCode = array_map(function ($field) {
            return self::buildField($field);
        }, $fields);

        $code = file_get_contents(__DIR__ . '/resources/object.php.txt');

        return str_replace(
            [
                '%BUILDER_USE%',
                '%BUILDER_DESCRIPTION%',
                '%BUILDER_STANDARD_DOCBLOCK%',
                '%BUILDER_NAME%',
                '%BUILDER_INTERFACES%',
                '%BUILDER_FIELDS%',
            ],
            [
                $use,
                $type['description'] ?? 'Description not provided',
                implode("\n", self::$standardDocBlock),
                $type['name'],
                $interfaces,
                rtrim(implode("\n", $fieldCode)),
            ],
            $code
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
        $fields = $type['inputFields'];

        $fieldCode = array_map(function ($field) {
            return self::buildField($field);
        }, $fields);

        $code = file_get_contents(__DIR__ . '/resources/input_object.php.txt');

        return str_replace(
            [
                '%BUILDER_DESCRIPTION%',
                '%BUILDER_STANDARD_DOCBLOCK%',
                '%BUILDER_NAME%',
                '%BUILDER_FIELDS%',
            ],
            [
                $type['description'] ?? 'Description not provided',
                implode("\n", self::$standardDocBlock),
                $type['name'],
                rtrim(implode("\n", $fieldCode)),
            ],
            $code
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
        $code = file_get_contents(__DIR__ . '/resources/interface.php.txt');

        return str_replace(
            [
                '%BUILDER_DESCRIPTION%',
                '%BUILDER_STANDARD_DOCBLOCK%',
                '%BUILDER_NAME%',
            ],
            [
                $type['description'] ?? 'Description not provided',
                implode("\n", self::$standardDocBlock),
                $type['name'],
            ],
            $code
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

        $fieldsCode = implode("\n", $fieldsCode);
        $possibleValues = implode(",\n", $possibleValues);

        $code = file_get_contents(__DIR__ . '/resources/enum.php.txt');

        return str_replace(
            [
                '%BUILDER_DESCRIPTION%',
                '%BUILDER_STANDARD_DOCBLOCK%',
                '%BUILDER_NAME%',
                '%BUILDER_POSSIBLE_VALUES%',
                '%BUILDER_FIELDS%',
            ],
            [
                $type['description'] ?? 'Description not provided',
                implode("\n", self::$standardDocBlock),
                $type['name'],
                $possibleValues,
                $fieldsCode,
            ],
            $code
        );
    }

    /**
     * Builds the entire project, putting classes in their correct places
     *
     * @return void
     */
    public function build()
    {
        $accepts = array_keys(self::$paths);

        foreach ($this->schema as $type) {
            if (!in_array($type['kind'], $accepts) || substr($type['name'], 0, 2) === '__') {
                continue;
            }

            $code = null;
            $path = self::$paths[$type['kind']] ?? null;

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
                file_put_contents(
                    "$path/{$type['name']}.php",
                    $code
                );
            }
        }
    }
}
