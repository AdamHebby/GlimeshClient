<?php

namespace GlimeshClient\Objects;

/**
 * A channel timeout or ban
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChannelBan extends AbstractObjectModel
{
    /**
     * Channel the ban affects
     *
     * @var Channel
     */
    protected $channel;

    /**
     * When the ban expires
     *
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * Channel ban creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Reason for channel ban
     *
     * @var string
     */
    protected $reason;

    /**
     * Channel ban updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * User the ban affects
     *
     * @var User
     */
    protected $user;
}
