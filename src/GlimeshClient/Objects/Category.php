<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * Categories are the containers for live streaming content.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Category extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Unique category identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Category creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Name of the category
     *
     * @var ?string
     */
    public readonly ?string $name;

    /**
     * Slug of the category
     *
     * @var ?string
     */
    public readonly ?string $slug;

    /**
     * Subcategories within the category
     *
     * @var ?\ArrayObject<Subcategory>
     */
    public readonly ?\ArrayObject $subcategories;

    /**
     * Tags associated with the category
     *
     * @var ?\ArrayObject<Tag>
     */
    public readonly ?\ArrayObject $tags;

    /**
     * Category updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;
}
