<?php

namespace GlimeshClient\Builder\CodeBuilders;

use GlimeshClient\Builder\Resolver\ObjectResolver;
use GlimeshClient\Builder\Resolver\SchemaMappingResolver;

class FieldBuilder extends AbstractBuilder
{
    public function __construct(
        private ObjectResolver $objectResolver,
        private SchemaMappingResolver $resolver
    )
    {

    }

    public function buildFields(array $fields): string
    {
        $code = (array_map(function ($field) {
            return $this->buildField($field);
        }, $fields));

        $code = array_filter($code);

        return rtrim(implode("\n", $code));
    }

    public function buildField(array $field): string
    {
        if (($field['isDeprecated'] ?? false) === true) {
            return null;
        }

        $fieldType = $this->objectResolver->resolveField($field);
        $fieldDoc  = $fieldType;

        if (isset($this->resolver->getConnectionNodeMap()[$field['type']['name']]) ||
            (isset($field['type']['kind']) && $field['type']['kind'] === 'LIST')) {
            $fieldDoc = "\ArrayObject<$fieldType>";
            $fieldType = '\ArrayObject';
        }

        $description = $field['description'] ?? 'Description not provided';

        return self::templateValues(
            __DIR__ . '/../resources/field.php.txt',
            [
                '%BUILDER_FIELD_DESCRIPTION%' => $description,
                '%BUILDER_FIELD_TYPE%' => $fieldDoc,
                '%BUILDER_P_FIELD_TYPE%' => $fieldType,
                '%BUILDER_FIELD_NAME%' => $field['name']
            ]
        );
    }
}
