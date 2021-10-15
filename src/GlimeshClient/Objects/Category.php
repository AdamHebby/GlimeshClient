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
     * @var string
     */
    protected $id;

    /**
     * Name of the category
     *
     * @var String
     */
    protected $name;

    /**
     * Description not provided
     *
     * @var Category
     */
    protected $parent;

    /**
     * Slug of the category
     *
     * @var String
     */
    protected $slug;

    /**
     * Description not provided
     *
     * @var ArrayObject<Subcategory>
     */
    protected $subcategories;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $tagName;

    /**
     * Description not provided
     *
     * @var ArrayObject<Tag>
     */
    protected $tags;
}
