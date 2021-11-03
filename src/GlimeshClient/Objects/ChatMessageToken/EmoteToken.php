<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Interfaces\ChatMessageToken;
use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Chat Message Emote Token
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class EmoteToken extends AbstractObjectModel implements ChatMessageToken
{
    /**
     * Token src URL
     *
     * @var string
     */
    protected $src;

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
     * Emote Token URL
     *
     * @var string
     */
    protected $url;
}
