<?php

namespace GlimeshClient\Traits;

use GlimeshClient\Objects\AbstractObjectModel;
use GlimeshClient\Objects\PagedArrayObject;
use GlimeshClient\Objects\PageInfo;

/**
 * Trait for Resolving Glimesh Objects
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
trait ObjectResolverTrait
{
    use FieldMappingTrait;

    /**
     * Returns an object based on the key and data. If an array of objects, returns \ArrayObject
     *
     * @param string $key  key given by API results
     * @param array  $data data of object
     *
     * @return AbstractObjectModel|ArrayObject
     */
    protected static function getObject(string $key, array $data = []): object
    {
        $class = self::resolveObjectKey($key);

        if ($class === null) {
            throw new \Exception('Class not implemented for ' . $key);
        }
        if (self::isArrayOfObjects($key)) {
            $return = [];

            foreach ($data['edges'] as $itemKey => $item) {
                $return[$itemKey] = new $class($item['node']);
            }

            if (isset($data['pageInfo'])) {
                return new PagedArrayObject(
                    $return,
                    new PageInfo($data['pageInfo']),
                    $data['count'] ?? count($return)
                );
            }

            return new \ArrayObject($return);
        } else {
            if (enum_exists($class)) {
                return $class::from($data[0]);
            }

            return new $class($data);
        }
    }

    /**
     * Is this a Date Field?
     */
    protected static function isDateField(string $value): bool
    {
        return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $value);
    }

    /**
     * Should this key be an array or a single object
     */
    protected static function isArrayOfObjects(string $key): bool
    {
        return isset(self::$mappingMultiple[$key]);
    }

    /**
     * Return class for key
     */
    protected static function resolveObjectKey(string $key): ?string
    {
        if (self::isArrayOfObjects($key)) {
            return self::$mappingMultiple[$key];
        }

        if (isset(self::$mappingSingle[$key])) {
            return self::$mappingSingle[$key];
        }

        return null;
    }
}
