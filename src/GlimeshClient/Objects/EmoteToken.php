<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;
use GlimeshClient\Interfaces\ChatMessageToken;

/**
 * Chat Message Emote Token
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class EmoteToken extends AbstractObjectModel implements ChatMessageToken
{
    use ObjectModelTrait;

    /**
     * Token src URL
     *
     * @var ?string
     */
    public readonly ?string $src;

    /**
     * Token text
     *
     * @var ?string
     */
    public readonly ?string $text;

    /**
     * Token type
     *
     * @var ?string
     */
    public readonly ?string $type;
}
