<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A chat message sent to a channel by a user.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChatMessage extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Channel where the chat message occurs
     *
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * Unique chat message identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Chat message creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * The chat message.
     *
     * @var ?string
     */
    public readonly ?string $message;

    /**
     * List of chat message tokens used
     *
     * @var ?\ArrayObject<ChatMessageToken>
     */
    public readonly ?\ArrayObject $tokens;

    /**
     * Chat message updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * User who sent the chat message
     *
     * @var ?User
     */
    public readonly ?User $user;
}
