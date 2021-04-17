<?php

namespace GlimeshClient\Objects;

/**
 * Subcategories are specific games, topics, or genre's that exist under a Category.
 */
class Subcategory extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var string
     */
    protected $backgroundImageUrl;
    /**
     * Description not provided
     *
     * @var Category
     */
    protected $category;
    /**
     * Description not provided
     *
     * @var int
     */
    protected $id;
    /**
     * Description not provided
     *
     * @var DateTime
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
     * Description not provided
     *
     * @var string
     */
    protected $source;
    /**
     * Description not provided
     *
     * @var string
     */
    protected $sourceId;
    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;
    /**
     * Description not provided
     *
     * @var bool
     */
    protected $userCreated;

}
