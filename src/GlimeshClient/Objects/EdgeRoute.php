<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * An edge to watch a FTL stream.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-12
 */
class EdgeRoute extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Availability of edge for viewer traffic
     *
     * @var ?int
     */
    public readonly ?int $available;

    /**
     * List of recommended country codes, used for latency
     *
     * @var ?\ArrayObject<string>
     */
    public readonly ?\ArrayObject $countryCodes;

    /**
     * Edge hostname
     *
     * @var ?string
     */
    public readonly ?string $hostname;

    /**
     * ID of the edge route
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Edge created date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Edge priority
     *
     * @var ?int
     */
    public readonly ?int $priority;

    /**
     * Edge updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Fully qualified edge URL
     *
     * @var ?string
     */
    public readonly ?string $url;
}
