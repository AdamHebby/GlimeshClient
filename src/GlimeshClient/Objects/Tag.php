<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * Tags are user created labels that are either global or category specific.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class Tag extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Parent category
     *
     * @var ?Category
     */
    public readonly ?Category $category;

    /**
     * The number of streams started with this tag
     *
     * @var ?int
     */
    public readonly ?int $countUsage;

    /**
     * Unique tag identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Tag creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Name of the tag
     *
     * @var ?string
     */
    public readonly ?string $name;

    /**
     * URL friendly name of the tag
     *
     * @var ?string
     */
    public readonly ?string $slug;

    /**
     * Tag updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;
}
