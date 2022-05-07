<?php

namespace GlimeshClient\Objects;

/**
 * A follower is a user who subscribes to notifications for a particular user's channel.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Follower extends AbstractObjectModel
{
    /**
     * Does this follower have live notifications enabled?
     *
     * @var boolean
     */
    protected $hasLiveNotifications;

    /**
     * Unique follower identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Following creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * The streamer the user is following
     *
     * @var User
     */
    protected $streamer;

    /**
     * Following updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * The user that is following the streamer
     *
     * @var User
     */
    protected $user;
}
