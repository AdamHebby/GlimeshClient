<?php

namespace GlimeshClient\Objects;

/**
 * A stream is a single live stream in, either current or historical.
 */
class Stream extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var Int
     */
    protected $avgChatters;

    /**
     * Description not provided
     *
     * @var Int
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
     * @var Int
     */
    protected $countChatters;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $countViewers;

    /**
     * Description not provided
     *
     * @var DateTime
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
     * @var DateTime
     */
    protected $insertedAt;

    /**
     * Description not provided
     *
     * @var ArrayObject<StreamMetadata>
     */
    protected $metadata;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $newSubscribers;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $peakChatters;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $peakViewers;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $resubSubscribers;

    /**
     * Description not provided
     *
     * @var DateTime
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
     * @var String
     */
    protected $thumbnail;

    /**
     * The title of the stream.
     *
     * @var String
     */
    protected $title;

    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;
}
