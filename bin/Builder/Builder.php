<?php

namespace GlimeshClient\Builder;

use GlimeshClient\Traits\ObjectResolverTrait;


class Builder
{
    public $schema = [];
    public static $paths = [
        'INTERFACE'     => 'src/GlimeshClient/Interfaces',
        'OBJECT'        => 'src/GlimeshClient/Objects',
        'INPUT_OBJECT'  => 'src/GlimeshClient/Objects/Input',
        'ENUM'          => 'src/GlimeshClient/Objects/Enums',
    ];

    public static $standardDocBlock = [
        ' * @author Adam Hebden <adam@adamhebden.com>',
        ' * @copyright 2021 Adam Hebden',
        ' * @license GPL-3.0-or-later',
        ' * @package GlimeshClient',
    ];

    public static $links = [

    ];

    public static $replaceObjects = [
        'NaiveDateTime' => '\DateTime',
        'DateTime' => '\DateTime',
        'ID' => 'string',
    ];

    public function __construct(string $apiJsonFilePath)
    {
        $this->schema = json_decode(
            file_get_contents($apiJsonFilePath),
            true
        )['data']['__schema']['types'];
    }

    public static function resolveField(array $field): ?string
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
