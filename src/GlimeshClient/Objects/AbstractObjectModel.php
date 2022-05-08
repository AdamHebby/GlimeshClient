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
     * Get All possible properties, can exclude parameters
     *
     * @param array $exclude Parameters to exclude
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
    public function toArray($trimEmpty = true): array
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
