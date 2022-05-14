<?php

namespace GlimeshClient\Builder\CodeBuilders;

use GlimeshClient\Builder\Resolver\ObjectResolver;
use GlimeshClient\Builder\Resolver\SchemaMappingResolver;

class UtilsBuilder extends AbstractBuilder
{
    private ObjectResolver $objectResolver;

    public function __construct(
        private SchemaMappingResolver $resolver
    )
    {
        $this->objectResolver = new ObjectResolver($this->resolver);
    }

    public function buildFieldMappingTrait(): string
    {
        list($mappingSingle, $mappingMultiple) = $this->objectResolver->buildFieldToObjectMap();

        ksort($mappingMultiple);
        ksort($mappingSingle);

        $mappingMultipleCode = implode("\n", $this->buildClassArray($mappingMultiple));
        $mappingSingleCode   = implode("\n", $this->buildClassArray($mappingSingle));

        return self::templateValues(
            __DIR__ . '/../resources/FieldMappingTrait.php.txt',
            [
                '%BUILDER_MAPPING_MULTIPLE%' => $mappingMultipleCode,
                '%BUILDER_MAPPING_SINGLE%' => $mappingSingleCode,
            ]
        );
    }

    private function buildClassArray(array $mapping): array
    {
        $code = [];
        $maxLen = max(array_map('strlen', array_keys($mapping)));

        foreach ($mapping as $key => $object) {
            $object = trim($object, '\\');
            $class = "\GlimeshClient\Objects\\{$object}";
            $enum = "\GlimeshClient\Objects\\Enums\\{$object}";

            $tabString = str_repeat(' ', $maxLen - strlen($key));

            if (class_exists($class)) {
                $code[] = "        '{$key}'{$tabString} => {$class}::class,";
            }
            if (enum_exists($enum)) {
                $code[] = "        '{$key}'{$tabString} => {$enum}::class,";
            }
        }

        return $code;
    }
}

