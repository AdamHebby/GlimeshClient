<?php

namespace GlimeshClient\Objects;

/**
 * A subscription is an exchange of money for support.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Sub extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $endedAt;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $isActive;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $price;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $productName;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * Description not provided
     *
     * @var User
     */
    protected $streamer;

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
