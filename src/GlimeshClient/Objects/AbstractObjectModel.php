<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectResolverTrait;

/**
 * Standard Object for all Objects / Models used by Glimesh
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
abstract class AbstractObjectModel
{
    use ObjectResolverTrait;

    /**
     * Sets object parameters from data given by API, recursively
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $resolvedKey = self::resolveObjectKey($key);

                if ($resolvedKey !== null) {
                    $this->$key = self::getObject($key, is_array($value) ? $value : [$value]);
                } else {
                    $this->$key = $value;
                }

                if (is_string($value) && self::isDateField($value)) {
                    $this->$key = new \DateTime($value, new \DateTimeZone('UTC'));
                }

                if (is_numeric($value)) {
                    $this->$key = (int) $value;
                }
            }
        }
    }

    /**
     * Getter for Protected fields
     *
     * @param mixed $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name ?? null;
    }

    /**
     * Get All possible properties, can exclude parameters
     *
     * @param array $exclude Parameters to exclude
     *
     * @return array
     */
    public static function getAllKeys(array $exclude = []): array
    {
        $selfVars   = array_keys(get_class_vars(self::class));
        $staticVars = array_keys(get_class_vars(static::class));

        return array_diff($staticVars, $selfVars, $exclude);
    }

    /**
     * Get all Parameters that are not objects themselves, can exclude parameters
     *
     * @param array $exclude Parameters to exclude
     *
     * @return array
     */
    public static function getAllNonObjectKeys(array $exclude = []): array
    {
        $selfVars   = array_keys(get_class_vars(self::class));
        $staticVars = array_keys(get_class_vars(static::class));
        $objects    = array_merge(
            array_keys(self::$mappingMulitple),
            array_keys(self::$mappingSingle),
        );

        return array_diff($staticVars, $selfVars, $objects, $exclude);
    }

    /**
     * Converts the current object and all children to an array, stringifies DateTime objects
     *
     * @param bool $trimEmpty Removes any empty properties or objects
     *
     * @return array
     */
    public function toArray($trimEmpty = true)
    {
        $array = [];

        foreach ($this as $key => $value) {
            if ($value instanceof AbstractObjectModel) {
                $value = $value->toArray($trimEmpty);
            }

            if ($value instanceof \DateTimeInterface) {
                $value = $value->format('Y-m-d\TH:i:s');
            }

            if (!$trimEmpty || !empty($value)) {
                $array[$key] = $value;
            }
        }

        return $array;
    }
}
