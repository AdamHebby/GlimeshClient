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
     * @var bool
     */
    protected $canBan;
    /**
     * Description not provided
     *
     * @var bool
     */
    protected $canDelete;
    /**
     * Description not provided
     *
     * @var bool
     */
    protected $canLongTimeout;
    /**
     * Description not provided
     *
     * @var bool
     */
    protected $canShortTimeout;
    /**
     * Description not provided
     *
     * @var bool
     */
    protected $canUnTimeout;
    /**
     * Description not provided
     *
     * @var bool
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
