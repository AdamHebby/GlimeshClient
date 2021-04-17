<?php

namespace GlimeshClient\Objects;

/**
 * A chat message sent to a channel by a user.
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
     * @var int
     */
    protected $id;
    /**
     * Description not provided
     *
     * @var DateTime
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
     * @var ChatMessageToken
     */
    protected $tokens;
    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;
    /**
     * Description not provided
     *
     * @var User
     */
    protected $user;

}
