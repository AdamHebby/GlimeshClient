<?php

namespace GlimeshClient\Objects;

/**
 * Categories are the containers for live streaming content.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Category extends AbstractObjectModel
{
    /**
     * Unique category identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Name of the category
     *
     * @var string
     */
    protected $name;


    /**
     * Slug of the category
     *
     * @var string
     */
    protected $slug;

    /**
     * Subcategories within the category
     *
     * @var \ArrayObject<Subcategory>
     */
    protected $subcategories;


    /**
     * Tags associated with the category
     *
     * @var \ArrayObject<Tag>
     */
    protected $tags;
}
