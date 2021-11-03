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
     * Action performed
     *
     * @var string
     */
    protected $action;

    /**
     * Channel the event occurred in
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Event creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Moderator that performed the event
     *
     * @var ChannelModerator
     */
    protected $moderator;

    /**
     * Event updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Receiving user of the event
     *
     * @var User
     */
    protected $user;
}
