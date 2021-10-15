<?php

namespace GlimeshClient\Objects;

/**
 * A follower is a user who subscribes to notifications for a particular user's channel.
 */
class Follower extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var Boolean
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
     * @var DateTime
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
