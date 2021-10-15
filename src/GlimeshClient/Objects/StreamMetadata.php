<?php

namespace GlimeshClient\Objects;

/**
 * A single instance of stream metadata.
 */
class StreamMetadata extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var String
     */
    protected $audioCodec;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $ingestServer;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $ingestViewers;

    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $insertedAt;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $lostPackets;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $nackPackets;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $recvPackets;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $sourceBitrate;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $sourcePing;

    /**
     * Description not provided
     *
     * @var Stream
     */
    protected $stream;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $streamTimeSeconds;

    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $vendorName;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $vendorVersion;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $videoCodec;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $videoHeight;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $videoWidth;
}
