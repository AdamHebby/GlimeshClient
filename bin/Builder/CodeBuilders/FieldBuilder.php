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

        $fieldName = $this->objectResolver->resolveField($field);
        $fieldDoc  = $fieldName;

        if (in_array($fieldName, $this->resolver->getConnectionNodeMap()) ||
            isset($field['type']['kind']) && $field['type']['kind'] === 'LIST') {
            $fieldDoc = "\ArrayObject<$fieldName>";
            $fieldName = '\ArrayObject';
        }

        $description = $field['description'] ?? 'Description not provided';

        return self::templateValues(
            __DIR__ . '/../resources/field.php.txt',
            [
                '%BUILDER_FIELD_DESCRIPTION%' => $description,
                '%BUILDER_FIELD_TYPE%' => $fieldDoc,
                '%BUILDER_P_FIELD_TYPE%' => $fieldName,
                '%BUILDER_FIELD_NAME%' => $field['name']
            ]
        );
    }
}
