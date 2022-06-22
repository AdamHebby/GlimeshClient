<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * Subcategories are specific games, topics, or genre's that exist under a Category.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-12
 */
class Subcategory extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Subcategory background image URL
     *
     * @var ?string
     */
    public readonly ?string $backgroundImageUrl;

    /**
     * Parent category
     *
     * @var ?Category
     */
    public readonly ?Category $category;

    /**
     * Unique subcategory identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Subcategory creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Name of the subcategory
     *
     * @var ?string
     */
    public readonly ?string $name;

    /**
     * URL friendly name of the subcategory
     *
     * @var ?string
     */
    public readonly ?string $slug;

    /**
     * Subcategory source
     *
     * @var ?string
     */
    public readonly ?string $source;

    /**
     * Subcategory source ID
     *
     * @var ?string
     */
    public readonly ?string $sourceId;

    /**
     * Subcategory updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Was the subcategory created by a user?
     *
     * @var ?bool
     */
    public readonly ?bool $userCreated;
}
