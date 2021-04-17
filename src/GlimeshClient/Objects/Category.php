<?php

namespace GlimeshClient\Objects;

/**
 * Categories are the containers for live streaming content.
 */
class Category extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var int
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
     * Description not provided
     *
     * @var Subcategory
     */
    protected $subcategories;
    /**
     * Description not provided
     *
     * @var Tag
     */
    protected $tags;

}
