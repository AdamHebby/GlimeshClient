<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;
use GlimeshClient\Interfaces\ChatMessageToken;

/**
 * Chat Message Text Token
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class TextToken extends AbstractObjectModel implements ChatMessageToken
{
    use ObjectModelTrait;

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
