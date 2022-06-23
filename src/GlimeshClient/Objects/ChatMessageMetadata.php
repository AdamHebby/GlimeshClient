<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * Metadata attributed to the chat message
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class ChatMessageMetadata extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Was the user a admin at the time of this message
     *
     * @var ?bool
     */
    public readonly ?bool $admin;

    /**
     * Was the user a moderator at the time of this message
     *
     * @var ?bool
     */
    public readonly ?bool $moderator;

    /**
     * Was the user a platform_founder_subscriber at the time of this message
     *
     * @var ?bool
     */
    public readonly ?bool $platformFounderSubscriber;

    /**
     * Was the user a platform_supporter_subscriber at the time of this message
     *
     * @var ?bool
     */
    public readonly ?bool $platformSupporterSubscriber;

    /**
     * Was the user a streamer at the time of this message
     *
     * @var ?bool
     */
    public readonly ?bool $streamer;

    /**
     * Was the user a subscriber at the time of this message
     *
     * @var ?bool
     */
    public readonly ?bool $subscriber;
}
