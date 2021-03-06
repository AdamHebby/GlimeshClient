<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A moderation event that happened
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChannelModerationLog extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Action performed
     *
     * @var ?string
     */
    public readonly ?string $action;

    /**
     * Channel the event occurred in
     *
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * Event creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Moderator that performed the event
     *
     * @var ?ChannelModerator
     */
    public readonly ?ChannelModerator $moderator;

    /**
     * Event updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Receiving user of the event
     *
     * @var ?User
     */
    public readonly ?User $user;
}
