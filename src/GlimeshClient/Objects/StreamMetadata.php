<?php

namespace GlimeshClient\Objects;

/**
 * A single instance of stream metadata.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class StreamMetadata extends AbstractObjectModel
{
    /**
     * Stream audio codec
     *
     * @var string
     */
    protected $audioCodec;

    /**
     * Unique stream metadata identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Ingest Server URL
     *
     * @var string
     */
    protected $ingestServer;

    /**
     * Viewers on the ingest
     *
     * @var string
     */
    protected $ingestViewers;

    /**
     * Stream metadata created date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * Lost stream input data packets
     *
     * @var int
     */
    protected $lostPackets;

    /**
     * Negative Acknowledged stream input data packets
     *
     * @var int
     */
    protected $nackPackets;

    /**
     * Received stream input data packets
     *
     * @var int
     */
    protected $recvPackets;

    /**
     * Bitrate at the source
     *
     * @var int
     */
    protected $sourceBitrate;

    /**
     * Ping to the source
     *
     * @var int
     */
    protected $sourcePing;

    /**
     * Current stream metadata references
     *
     * @var Stream
     */
    protected $stream;

    /**
     * Current Stream time in seconds
     *
     * @var int
     */
    protected $streamTimeSeconds;

    /**
     * Stream metadata updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Client vendor name
     *
     * @var string
     */
    protected $vendorName;

    /**
     * Client vendor version
     *
     * @var string
     */
    protected $vendorVersion;

    /**
     * Stream video codec
     *
     * @var string
     */
    protected $videoCodec;

    /**
     * Stream video height
     *
     * @var int
     */
    protected $videoHeight;

    /**
     * Stream video width
     *
     * @var int
     */
    protected $videoWidth;
}
