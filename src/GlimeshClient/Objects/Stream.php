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
     * Average chatters during the stream
     *
     * @var int
     */
    protected $avgChatters;

    /**
     * Average viewers during the stream
     *
     * @var int
     */
    protected $avgViewers;

    /**
     * The category the current stream is in
     *
     * @var Category
     */
    protected $category;

    /**
     * Channel running with the stream
     *
     * @var Channel
     */
    protected $channel;

    /**
     * Concurrent chatters during last snapshot
     *
     * @var int
     */
    protected $countChatters;

    /**
     * Concurrent viewers during last snapshot
     *
     * @var int
     */
    protected $countViewers;

    /**
     * Datetime of when the stream ended, or null if still going
     *
     * @var \DateTime
     */
    protected $endedAt;

    /**
     * Unique stream identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Stream created date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Current stream metadata
     *
     * @var \ArrayObject<StreamMetadata>
     */
    protected $metadata;

    /**
     * Total new subscribers gained during the stream
     *
     * @var int
     */
    protected $newSubscribers;

    /**
     * Peak concurrent chatters
     *
     * @var int
     */
    protected $peakChatters;

    /**
     * Peak concurrent viewers
     *
     * @var int
     */
    protected $peakViewers;

    /**
     * Total resubscribers during the stream
     *
     * @var int
     */
    protected $resubSubscribers;

    /**
     * Datetime of when the stream was started
     *
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * The subategory the current stream is in
     *
     * @var Subcategory
     */
    protected $subcategory;

    /**
     * Thumbnail URL of the stream
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
     * Stream updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;
}
