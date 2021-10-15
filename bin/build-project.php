<?php

use GlimeshClient\Traits\ObjectResolverTrait;

require_once __DIR__ . '/../vendor/autoload.php';

$api = json_decode(file_get_contents(__DIR__ . '/../etc/api.json'), true);

$schema = ($api['data']['__schema']['types']);

$paths = [
    'interfaces' => 'src/GlimeshClient/Interfaces/',
    'objects' => 'src/GlimeshClient/Objects/',
];

$replaceObjects = [
    'naivedatetime' => 'DateTime',
    'id' => 'string',
];

$accepts =  ['OBJECT', 'INTERFACE', 'INPUT_OBJECT', 'ENUM'];

foreach ($schema as $type) {
    if (!in_array($type['kind'], $accepts) || substr($type['name'], 0, 2) === '__') {
        echo "{$type['kind']} not set of name {$type['name']} \n";
        continue;
    }

    $name        = $type['name'];
    $description = $type['description'] ?? 'Description not provided';
    $enumValues  = $type['enumValues'];
    $fields      = $type['fields'] ?? ($type['inputFields'] ?? []);
    $interfaces  = empty($type['interfaces']) ? null : ' implements ' . $type['interfaces'][0]['name'];
    $kind        = $type['kind'];

    $use = '';
    if (!empty($interfaces)) {
        $use .= "\nuse GlimeshClient\Interfaces\\{$type['interfaces'][0]['name']};\n";
        $use .= "use GlimeshClient\Objects\AbstractObjectModel;\n";
    }

    $fieldsCode = '';

    foreach ($fields as $field) {
        $fieldDesc = $field['description'] ?? 'Description not provided';
        $fieldType = !empty($field['type']['name'])
            ? $field['type']['name']
            : $field['type']['ofType']['name'];

        $isList = ($field['type']['kind'] === 'LIST');

        $resolvedType = ObjectResolverTrait::resolveObjectKey(strtolower($fieldType));

        if ($isList) {
            $fieldType = "ArrayObject<$fieldType>";
        } elseif ($resolvedType !== null) {
            $reflect = new ReflectionClass($resolvedType);
            $fieldType = $reflect->getShortName();
        } elseif (!class_exists($fieldType)) {
            $fieldType = strtolower($fieldType);
        }


        if (isset($replaceObjects[strtolower($fieldType)])) {
            $fieldType = $replaceObjects[strtolower($fieldType)];
        }

        $fieldsCode .= "\n    /**
     * {$fieldDesc}
     *
     * @var {$fieldType}
     */\n    protected \${$field['name']};\n";
    }

    $fieldsCode = trim($fieldsCode);
    $path = '';

    if ($kind === 'OBJECT') {
        $path = 'src/GlimeshClient/Objects/' . (!empty($interfaces) ? "{$type['interfaces'][0]['name']}/" : '') . $name . ".php";
        $contents = "<?php

namespace GlimeshClient\Objects;
$use
/**
 * $description
 */
class $name extends AbstractObjectModel{$interfaces}
{
    $fieldsCode
}\n";

    } elseif ($kind === 'INTERFACE') {
        $path = 'src/GlimeshClient/Interfaces/' . $name . ".php";
        $contents = "<?php

namespace GlimeshClient\Interfaces;

/**
 * Description not provided
 */
interface $name
{
}\n";
    } elseif ($kind === 'INPUT_OBJECT') {
        $path = 'src/GlimeshClient/Objects/Input/' . $name . ".php";
        $contents = "<?php

namespace GlimeshClient\Objects\Input;

/**
 * $description
 */
class $name extends AbstractInputObjectModel
{
    $fieldsCode
}\n";

    } elseif ($kind === 'ENUM') {
        $path = 'src/GlimeshClient/Objects/Enums/' . $name . ".php";
        $possibleValues = array_map(function ($enum) {
            return "        \"{$enum['name']}\"";
        }, $type['enumValues']);


        $fieldsCode = array_map(function ($enum) {
            return "    public const {$enum['name']} = \"{$enum['name']}\";";
        }, $type['enumValues']);

        $fieldsCode = implode("\n", $fieldsCode);
        $possibleValues = implode(",\n", $possibleValues);
        $contents = "<?php

namespace GlimeshClient\Objects\Enums;

/**
 * $description
 */
class {$name} extends AbstractEnumObject
{
    public const POSSIBLE_VALUES = [
$possibleValues
    ];
$fieldsCode
}\n";
    }

    file_put_contents($path, $contents);
}

