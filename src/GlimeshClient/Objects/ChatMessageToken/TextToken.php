<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Interfaces\ChatMessageToken;
use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Description not provided
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class TextToken extends AbstractObjectModel implements ChatMessageToken
{
    /**
     * Description not provided
     *
     * @var string
     */
    protected $text;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $type;
}
