<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A linked social account for a Glimesh user.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class UserSocial extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Unique social account identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Platform unique identifier, usually a ID, made into a string
     *
     * @var ?string
     */
    public readonly ?string $identifier;

    /**
     * User socials created date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Platform that is linked, eg: twitter
     *
     * @var ?string
     */
    public readonly ?string $platform;

    /**
     * User socials updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Username for the user on the linked platform
     *
     * @var ?string
     */
    public readonly ?string $username;
}
