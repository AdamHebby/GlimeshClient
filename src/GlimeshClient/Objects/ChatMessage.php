<?php

namespace GlimeshClient\Objects;

/**
 * A chat message sent to a channel by a user.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChatMessage extends AbstractObjectModel
{
    /**
     * Channel where the chat message occurs
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Unique chat message identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Chat message creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * The chat message.
     *
     * @var string
     */
    protected $message;

    /**
     * List of chat message tokens used
     *
     * @var \ArrayObject<ChatMessageToken>
     */
    protected $tokens;

    /**
     * Chat message updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * User who sent the chat message
     *
     * @var User
     */
    protected $user;
}
