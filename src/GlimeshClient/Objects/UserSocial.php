<?php

namespace GlimeshClient\Objects;

/**
 * A linked social account for a Glimesh user.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class UserSocial extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * Platform unique identifier, usually a ID, made into a string
     *
     * @var string
     */
    protected $identifier;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Platform that is linked, eg: twitter
     *
     * @var string
     */
    protected $platform;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Username for the user on the linked platform
     *
     * @var string
     */
    protected $username;
}
