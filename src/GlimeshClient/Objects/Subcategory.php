<?php

namespace GlimeshClient\Objects;

/**
 * Subcategories are specific games, topics, or genre's that exist under a Category.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Subcategory extends AbstractObjectModel
{
    /**
     * Subcategory background image URL
     *
     * @var string
     */
    protected $backgroundImageUrl;

    /**
     * Parent category
     *
     * @var Category
     */
    protected $category;

    /**
     * ID of subcategory
     *
     * @var string
     */
    protected $id;

    /**
     * Subcategory creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Name of the subcategory
     *
     * @var string
     */
    protected $name;

    /**
     * URL friendly name of the subcategory
     *
     * @var string
     */
    protected $slug;

    /**
     * Subcategory source
     *
     * @var string
     */
    protected $source;

    /**
     * Subcategory source ID
     *
     * @var string
     */
    protected $sourceId;

    /**
     * Subcategory updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Was the subcategory created by a user?
     *
     * @var boolean
     */
    protected $userCreated;
}
