<?php

namespace GlimeshClient\Objects;

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
    /**
     * When the subscription ended
     *
     * @var \DateTime
     */
    protected $endedAt;

    /**
     * Subscription unique identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Subscription created date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Is the subscription currently active?
     *
     * @var boolean
     */
    protected $isActive;

    /**
     * Price of the subscription
     *
     * @var int
     */
    protected $price;

    /**
     * Subscription product name
     *
     * @var string
     */
    protected $productName;

    /**
     * When the subscription started
     *
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * The streamer receiving the support from the subscription
     *
     * @var User
     */
    protected $streamer;

    /**
     * Subscription updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * The user giving the support with the subscription
     *
     * @var User
     */
    protected $user;
}
