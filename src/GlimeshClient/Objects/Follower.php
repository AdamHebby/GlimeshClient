<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

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
    use ObjectModelTrait;

    /**
     * Does this follower have live notifications enabled?
     *
     * @var ?bool
     */
    public readonly ?bool $hasLiveNotifications;

    /**
     * Unique follower identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Following creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * The streamer the user is following
     *
     * @var ?User
     */
    public readonly ?User $streamer;

    /**
     * Following updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * The user that is following the streamer
     *
     * @var ?User
     */
    public readonly ?User $user;
}
