<?php

namespace GlimeshClient\Builder\Resolver;

/**
 * Resolves Connection objects in the Schema to their corresponding objects
 */
class SchemaMappingResolver
{
    private array $objects = [];

    private array $interfaces = [];

    private array $enums = [];

    private array $inputObjects = [];

    private array $connectionNodeMap = [];

    private static array $ignoreTypes = [
        'RootMutationType'
    ];

    private static array $acceptsTypes = [
        'INTERFACE',
        'OBJECT',
        'INPUT_OBJECT',
        'ENUM',
    ];

    public function __construct(
        array $schema
    ) {
        $schema = $this->unsetUnacceptedObjects($schema);

        $this->connectionNodeMap = SchemaConnectionNodeMapResolver::resolveSchema(
            $schema
        );

        foreach ($schema as $type) {
            if (SchemaConnectionNodeMapResolver::isAnEdge($type) ||
                SchemaConnectionNodeMapResolver::isANode($type)
            ) {
                continue;
            }

            switch ($type['kind']) {
                case 'OBJECT':
                    $this->objects[$type['name']] = $type;
                    break;

                case 'INTERFACE':
                    $this->interfaces[$type['name']] = $type;
                    break;

                case 'INPUT_OBJECT':
                    $this->inputObjects[$type['name']] = $type;
                    break;

                case 'ENUM':
                    $this->enums[$type['name']] = $type;
                    break;
            }
        }
    }

    public function getObjectByName(string $name): array
    {
        return $this->objects[$name];
    }

    public function getObjects(): array
    {
        return $this->objects;
    }

    public function getInterfaces(): array
    {
        return $this->interfaces;
    }

    public function getEnums(): array
    {
        return $this->enums;
    }

    public function getInputObjects(): array
    {
        return $this->inputObjects;
    }

    public function getConnectionNodeMap(): array
    {
        return $this->connectionNodeMap;
    }

    private function unsetUnacceptedObjects(array $schema): array
    {
        foreach ($schema as $key => $type) {
            if (!in_array($type['kind'], self::$acceptsTypes) ||
                in_array($type['name'], self::$ignoreTypes) ||
                substr($type['name'], 0, 2) === '__'
            ) {
                unset($schema[$key]);
                continue;
            }
        }

        return $schema;
    }
}
