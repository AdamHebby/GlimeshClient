<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A channel moderator
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class ChannelModerator extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Can ban a user
     *
     * @var ?bool
     */
    public readonly ?bool $canBan;

    /**
     * Can delete a message
     *
     * @var ?bool
     */
    public readonly ?bool $canDelete;

    /**
     * Can perform a long timeout action
     *
     * @var ?bool
     */
    public readonly ?bool $canLongTimeout;

    /**
     * Can perform a short timeout action
     *
     * @var ?bool
     */
    public readonly ?bool $canShortTimeout;

    /**
     * Can untimeout a user
     *
     * @var ?bool
     */
    public readonly ?bool $canUnTimeout;

    /**
     * Can unban a user
     *
     * @var ?bool
     */
    public readonly ?bool $canUnban;

    /**
     * Channel the moderator can moderate in
     *
     * @var ?\ArrayObject<Channel>
     */
    public readonly ?\ArrayObject $channel;

    /**
     * Unique channel moderator identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Moderator creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Moderator updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Moderating User
     *
     * @var ?\ArrayObject<User>
     */
    public readonly ?\ArrayObject $user;
}
