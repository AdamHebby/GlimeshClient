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
     * Description not provided
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * Description not provided
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
     * Description not provided
     *
     * @var \ArrayObject<ChatMessageToken>
     */
    protected $tokens;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Description not provided
     *
     * @var User
     */
    protected $user;
}
