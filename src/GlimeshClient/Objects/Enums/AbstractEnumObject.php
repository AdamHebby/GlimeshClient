<?php

namespace GlimeshClient\Objects\Enums;

use GlimeshClient\Objects\AbstractObjectModel;

/**
 * An Abstract ENUM Object
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
abstract class AbstractEnumObject extends AbstractObjectModel
{
    /**
     * All possible values of an ENUM
     */
    public const POSSIBLE_VALUES = [];

    /**
     * Current set ENUM value
     *
     * @var string
     */
    protected $currentValue;

    /**
     * Sets the ENUM value if in POSSIBLE_VALUES
     *
     * @param array $value
     */
    public function __construct(array $value)
    {
        if (in_array(reset($value), static::POSSIBLE_VALUES)) {
            $this->currentValue = reset($value);
        }
    }
}
