<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Interfaces\ChatMessageToken;
use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Chat Message URL Token
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class UrlToken extends AbstractObjectModel implements ChatMessageToken
{
    /**
     * Token text
     *
     * @var string
     */
    protected $text;

    /**
     * Token type
     *
     * @var string
     */
    protected $type;

    /**
     * Token URL
     *
     * @var string
     */
    protected $url;
}
