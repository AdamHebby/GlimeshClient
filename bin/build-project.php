<?php

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

$accepts =  ['OBJECT', 'INTERFACE', 'INPUT_OBJECT'];

foreach ($schema as $type) {
    if (!in_array($type['kind'], $accepts) || substr($type['name'], 0, 2) === '__') {
        echo "{$type['kind']} not set \n";
        continue;
    }

    $name        = $type['name'];
    $description = $type['description'] ?? 'Description not provided';
    $enumValues  = $type['enumValues'];
    $fields      = $type['fields'] ?? $type['inputFields'];
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

        if ($isList) {
            $fieldType = "ArrayObject<$fieldType>";
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

    }

    file_put_contents($path, $contents);
}

