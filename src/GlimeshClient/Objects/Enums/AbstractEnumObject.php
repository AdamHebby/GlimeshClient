<?php

namespace GlimeshClient\Objects\Enums;

use GlimeshClient\Objects\AbstractObjectModel;

abstract class AbstractEnumObject extends AbstractObjectModel
{
    public const POSSIBLE_VALUES = [];
    protected $currentValue;

    public function __construct(array $value)
    {
        if (in_array(reset($value), static::POSSIBLE_VALUES)) {
            $this->currentValue = reset($value);
        }
    }
}
