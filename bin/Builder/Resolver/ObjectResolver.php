<?php

namespace GlimeshClient\Builder\Resolver;

class ObjectResolver
{
    public static array $replacements = [
        'Boolean'       => 'bool',
        'NaiveDateTime' => '\DateTime',
        'DateTime'      => '\DateTime',
        'ID'            => 'string',
    ];

    public function __construct(
        private readonly SchemaMappingResolver $resolver
    )
    {

    }

    public function buildFieldToObjectMap(): array
    {
        $objects = $this->resolver->getObjects();
        $connectionNodeMap = $this->resolver->getConnectionNodeMap();

        $mapSingle = $mapMulitple = [];
        foreach ($objects as $object) {
            $fields = $object['fields'];

            foreach ($fields as $field) {
                $resolvedType = $this->resolveField($field);

                if (in_array($resolvedType, ['string', 'int', 'bool'])) {
                    continue;
                }
                if (
                    (isset($field['type']['kind']) && $field['type']['kind'] === 'LIST') ||
                    isset($connectionNodeMap[$field['type']['name']])
                ) {
                    $mapMulitple[$field['name']] = $resolvedType;
                } else {
                    $mapSingle[$field['name']] = $resolvedType;
                }
            }
        }

        return [$mapSingle, $mapMulitple];
    }

    public function resolveField(array $field): string
    {
        $typeName = isset($field['type']['name']) ? $field['type']['name'] : '';

        $resolvedType = null;

        $connectionNodeMap = $this->resolver->getConnectionNodeMap();

        if (isset($connectionNodeMap[$typeName])) {
            $resolvedType = $connectionNodeMap[$typeName];
        }

        if ($resolvedType !== null) {
            $resolvedType = preg_replace('/(.*?)\\\([a-z]+)$/i', "$2", $resolvedType);
        }

        if ($resolvedType === null && isset($field['type']['ofType']['name'])) {
            $resolvedType = $field['type']['ofType']['name'];
        }

        if (in_array(strtolower($resolvedType), ['string', 'int'])) {
            $resolvedType = strtolower($resolvedType);
        }

        if (in_array(strtolower($typeName), ['string', 'int'])) {
            $resolvedType = strtolower($typeName);
        }

        if (isset(self::$replacements[$resolvedType])) {
            $resolvedType = self::$replacements[$resolvedType];
        }

        if (isset(self::$replacements[$typeName])) {
            $resolvedType = self::$replacements[$typeName];
        }

        return $resolvedType ?? $typeName;
    }
}
