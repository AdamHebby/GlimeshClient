<?php

namespace GlimeshClient\Objects;

/**
 * A channel moderator
 */
class ChannelModerator extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $canBan;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $canDelete;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $canLongTimeout;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $canShortTimeout;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $canUnTimeout;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $canUnban;

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
