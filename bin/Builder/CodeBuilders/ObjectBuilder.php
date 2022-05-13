<?php

namespace GlimeshClient\Builder\CodeBuilders;

class ObjectBuilder extends AbstractBuilder
{
    public function __construct(
        private FieldBuilder $fieldBuilder
    ) {}

    public function buildObjectCode(
        array $object
    ): string {
        $fields = $object['fields'];

        $use = [
            "use GlimeshClient\Traits\ObjectModelTrait;"
        ];

        $interfaces   = $this->getInterfaceImplements($object['interfaces']);
        $interfaceUse = $this->getInterfaceUsage($object['interfaces']);
        $fieldUsage   = $this->getFieldUsage($fields);

        $use = array_unique([...$use, ...$interfaceUse, ...$fieldUsage]);

        if (!empty($interfaces)) {
            $interfaces = ' implements ' . implode(', ', $interfaces);
        } else {
            $interfaces = '';
        }

        return self::templateValues(__DIR__ . '/../resources/object.php.txt', [
            '%BUILDER_USE%' => "\n" . implode("\n", $use) . "\n",
            '%BUILDER_DESCRIPTION%' => $object['description'] ?? 'Description not provided',
            '%BUILDER_STANDARD_DOCBLOCK%' => implode("\n", self::$standardDocBlock),
            '%BUILDER_NAME%' => $object['name'],
            '%BUILDER_INTERFACES%' => $interfaces,
            '%BUILDER_FIELDS%' => $this->fieldBuilder->buildFields($fields),
        ]);
    }

    protected function getInterfaceUsage(?array $interfaces = []): array
    {
        if (empty($interfaces)) {
            return [];
        }

        $use = [];
        foreach ($interfaces as $interface) {
            $use[] = "use GlimeshClient\Interfaces\\{$interface['name']};";
        }

        return $use;
    }

    protected function getInterfaceImplements(?array $interfaces = []): array
    {
        if (empty($interfaces)) {
            return [];
        }

        $implements = [];
        foreach ($interfaces as $interface) {
            $implements[] = $interface['name'];
        }

        return $implements;
    }


    protected function getFieldUsage(array $fields): array
    {
        $baseNamespace = 'GlimeshClient\\Objects';
        $use = [];

        foreach ($fields as $field) {
            $typeName = $field['type']['name'];

            $newUse = match ($field['type']['kind']) {
                'ENUM'   => "use {$baseNamespace}\\Enums\\{$typeName};",
                default => null,
            };

            if ($newUse) {
                $use[] = $newUse;
            }
        }

        return $use;
    }
}
