<?php

namespace GlimeshClient\Traits;

/**
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-07
 */
trait ObjectModelTrait
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
                } elseif (is_string($value) && self::isDateField($value)) {
                    $this->$key = new \DateTime($value, new \DateTimeZone('UTC'));
                } elseif (is_numeric($value)) {
                    $this->$key = (int) $value;
                } else {
                    $this->$key = $value;
                }
            }
        }

        $reflect = new \ReflectionClass($this);

        // Foreach key not given, set the value to null
        $keys = array_diff(
            array_column($reflect->getProperties(\ReflectionProperty::IS_READONLY), 'name'),
            array_keys($data)
        );
        foreach ($keys as $key) {
            $this->$key = null;
        }
    }
}
