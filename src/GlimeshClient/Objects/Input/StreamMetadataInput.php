<?php

namespace GlimeshClient\Objects\Input;

/**
 * Description not provided
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-12
 */
class StreamMetadataInput extends AbstractInputObjectModel
{
    /**
     * Stream audio codec
     *
     * @var ?string
     */
    public readonly ?string $audioCodec;

    /**
     * Ingest Server URL
     *
     * @var ?string
     */
    public readonly ?string $ingestServer;

    /**
     * Viewers on the ingest
     *
     * @var ?int
     */
    public readonly ?int $ingestViewers;

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
     * Current Stream time in seconds
     *
     * @var ?int
     */
    public readonly ?int $streamTimeSeconds;

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
