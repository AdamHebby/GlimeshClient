<?php

namespace GlimeshClient\Objects;

/**
 * Tags are user created labels that are either global or category specific.
 */
class Tag extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var Category
     */
    protected $category;
    /**
     * The number of streams started with this tag
     *
     * @var int
     */
    protected $countUsage;
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
     * Name of the tag
     *
     * @var string
     */
    protected $name;
    /**
     * URL friendly name of the tag
     *
     * @var string
     */
    protected $slug;
    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;

}