<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

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
    use ObjectModelTrait;

    /**
     * Channel the ban affects
     *
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * When the ban expires
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $expiresAt;

    /**
     * Channel ban creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Reason for channel ban
     *
     * @var ?string
     */
    public readonly ?string $reason;

    /**
     * Channel ban updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * User the ban affects
     *
     * @var ?User
     */
    public readonly ?User $user;
}
