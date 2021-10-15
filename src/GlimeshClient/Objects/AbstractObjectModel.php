<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectResolverTrait;

/**
 * Standard Object for all Objects / Models used by Glimesh
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
