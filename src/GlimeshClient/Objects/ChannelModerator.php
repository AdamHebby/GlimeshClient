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
     * Can ban a user
     *
     * @var boolean
     */
    protected $canBan;

    /**
     * Can delete a message
     *
     * @var boolean
     */
    protected $canDelete;

    /**
     * Can perform a long timeout action
     *
     * @var boolean
     */
    protected $canLongTimeout;

    /**
     * Can perform a short timeout action
     *
     * @var boolean
     */
    protected $canShortTimeout;

    /**
     * Can untimeout a user
     *
     * @var boolean
     */
    protected $canUnTimeout;

    /**
     * Can unban a user
     *
     * @var boolean
     */
    protected $canUnban;

    /**
     * Channel the moderator can moderate in
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Moderator creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Moderator updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Moderating User
     *
     * @var User
     */
    protected $user;
}
