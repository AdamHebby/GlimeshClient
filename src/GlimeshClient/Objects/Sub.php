<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A subscription is an exchange of money for support.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Sub extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * When the subscription ended
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $endedAt;

    /**
     * Subscription unique identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Subscription created date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Is the subscription currently active?
     *
     * @var ?bool
     */
    public readonly ?bool $isActive;

    /**
     * Price of the subscription
     *
     * @var ?int
     */
    public readonly ?int $price;

    /**
     * Subscription product name
     *
     * @var ?string
     */
    public readonly ?string $productName;

    /**
     * When the subscription started
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $startedAt;

    /**
     * The streamer receiving the support from the subscription
     *
     * @var ?User
     */
    public readonly ?User $streamer;

    /**
     * Subscription updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * The user giving the support with the subscription
     *
     * @var ?User
     */
    public readonly ?User $user;
}
