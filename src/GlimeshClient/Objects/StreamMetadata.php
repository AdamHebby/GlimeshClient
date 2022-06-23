<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A single instance of stream metadata.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-23
 */
class StreamMetadata extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Stream audio codec
     *
     * @var ?string
     */
    public readonly ?string $audioCodec;

    /**
     * Unique stream metadata identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Ingest Server URL
     *
     * @var ?string
     */
    public readonly ?string $ingestServer;

    /**
     * Viewers on the ingest
     *
     * @var ?string
     */
    public readonly ?string $ingestViewers;

    /**
     * Stream metadata created date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Lost stream input data packets
     *
     * @var ?int
     */
    public readonly ?int $lostPackets;

    /**
     * Negative Acknowledged stream input data packets
     *
     * @var ?int
     */
    public readonly ?int $nackPackets;

    /**
     * Received stream input data packets
     *
     * @var ?int
     */
    public readonly ?int $recvPackets;

    /**
     * Bitrate at the source
     *
     * @var ?int
     */
    public readonly ?int $sourceBitrate;

    /**
     * Ping to the source
     *
     * @var ?int
     */
    public readonly ?int $sourcePing;

    /**
     * Current stream metadata references
     *
     * @var ?Stream
     */
    public readonly ?Stream $stream;

    /**
     * Current Stream time in seconds
     *
     * @var ?int
     */
    public readonly ?int $streamTimeSeconds;

    /**
     * Stream metadata updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Client vendor name
     *
     * @var ?string
     */
    public readonly ?string $vendorName;

    /**
     * Client vendor version
     *
     * @var ?string
     */
    public readonly ?string $vendorVersion;

    /**
     * Stream video codec
     *
     * @var ?string
     */
    public readonly ?string $videoCodec;

    /**
     * Stream video height
     *
     * @var ?int
     */
    public readonly ?int $videoHeight;

    /**
     * Stream video width
     *
     * @var ?int
     */
    public readonly ?int $videoWidth;
}
