<?php

namespace GlimeshClient\Builder\Resolver;

/**
 * Resolves Connection objects in the Schema to their corresponding objects
 */
class SchemaConnectionNodeMapResolver
{
    /**
     * Resolves the schema to a connection node map
     *
     * @param array $schema The schema to resolve
     *
     * @return array
     */
    public static function resolveSchema(array $schema): array
    {
        $connectionEdgeMap = $nodeObjectMap = $connectionNodeMap = [];

        foreach ($schema as $type) {
            $fields = $type['fields'] ?? [];
            if (self::isANode($type)) {
                $connectionEdgeMap[$type['name']] = self::getEdgeFromConnectionFields($fields);
            }

            if (self::isAnEdge($type)) {
                $nodeObjectMap[$type['name']] = self::getNodeFromEdgeFields($fields);
            }
        }

        foreach ($connectionEdgeMap as $connectionName => $edgeName) {
            if (!isset($nodeObjectMap[$edgeName])) {
                throw new \Exception("Edge {$edgeName} is not a node");
            }

            $connectionNodeMap[$connectionName] = $nodeObjectMap[$edgeName];
        }

        return $connectionNodeMap;
    }

    /**
     * Is the field an edge?
     *
     * @param array $field
     *
     * @return bool
     */
    public static function isAnEdge(array $field): bool
    {
        return str_ends_with($field['name'] ?? '', 'Edge');
    }

    /**
     * Is the field a node?
     *
     * @param array $field
     *
     * @return bool
     */
    public static function isANode(array $field): bool
    {
        return str_ends_with($field['name'] ?? '', 'Connection');
    }

    /**
     * get the edge from the connection fields
     *
     * @param array $fields
     *
     * @return string
     */
    protected static function getEdgeFromConnectionFields(array $fields): string
    {
        foreach ($fields as $field) {
            if ($field['name'] === 'edges') {
                return $field['type']['ofType']['name'];
            }
        }
    }

    /**
     * get the node from the edge fields
     *
     * @param array $fields
     *
     * @return string
     */
    protected static function getNodeFromEdgeFields(array $fields): string
    {
        foreach ($fields as $field) {
            if ($field['name'] === 'node') {
                return $field['type']['name'];
            }
        }
    }
}
