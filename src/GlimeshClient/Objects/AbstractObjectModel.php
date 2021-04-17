<?php

namespace GlimeshClient\Objects;

use DateTimeZone;
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
                $this->$key = (self::resolveObjectKey($key) === null)
                    ? $value
                    : self::getObject($key, $value);

                if (is_string($value) && self::isDateField($value)) {
                    $this->$key = new \DateTime($value, new DateTimeZone('UTC'));
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
}
