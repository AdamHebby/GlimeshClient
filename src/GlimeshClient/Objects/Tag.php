<?php

namespace GlimeshClient\Objects;

/**
 * Tags are user created labels that are either global or category specific.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Tag extends AbstractObjectModel
{
    /**
     * Parent category
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
     * Unique tag identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Tag creation date
     *
     * @var \DateTime
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
     * Tag updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;
}
