<?php

namespace GlimeshClient\Objects;

/**
 * A follower is a user who subscribes to notifications for a particular user's channel.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Follower extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $hasLiveNotifications;

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
     * Description not provided
     *
     * @var User
     */
    protected $streamer;

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
