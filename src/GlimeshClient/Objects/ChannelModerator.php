<?php

namespace GlimeshClient\Objects;

/**
 * A channel moderator
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChannelModerator extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $canBan;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $canDelete;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $canLongTimeout;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $canShortTimeout;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $canUnTimeout;

    /**
     * Description not provided
     *
     * @var boolean
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
     * @var \DateTime
     */
    protected $insertedAt;

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
