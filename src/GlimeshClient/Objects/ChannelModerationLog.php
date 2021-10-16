<?php

namespace GlimeshClient\Objects;

/**
 * A moderation event that happened
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
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
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Description not provided
     *
     * @var ChannelModerator
     */
    protected $moderator;

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
