<?php

namespace GlimeshClient\Objects;

/**
 * A moderation event that happened
 */
class ChannelModerationLog extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var string
     */
    protected $action;

    /**
     * Description not provided
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $insertedAt;

    /**
     * Description not provided
     *
     * @var User
     */
    protected $moderator;

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
