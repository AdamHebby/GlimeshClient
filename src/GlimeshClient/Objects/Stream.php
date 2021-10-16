<?php

namespace GlimeshClient\Objects;

/**
 * A stream is a single live stream in, either current or historical.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Stream extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var int
     */
    protected $avgChatters;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $avgViewers;

    /**
     * Description not provided
     *
     * @var Category
     */
    protected $category;

    /**
     * Description not provided
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $countChatters;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $countViewers;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $endedAt;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Description not provided
     *
     * @var \ArrayObject<StreamMetadata>
     */
    protected $metadata;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $newSubscribers;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $peakChatters;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $peakViewers;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $resubSubscribers;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * Description not provided
     *
     * @var Subcategory
     */
    protected $subcategory;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $thumbnail;

    /**
     * The title of the stream.
     *
     * @var string
     */
    protected $title;

    /**
     * Description not provided
     *
     * @var \DateTime
     */
    protected $updatedAt;
}
