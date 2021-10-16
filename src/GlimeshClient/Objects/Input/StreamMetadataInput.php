<?php

namespace GlimeshClient\Objects\Input;

/**
 * Description not provided
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class StreamMetadataInput extends AbstractInputObjectModel
{
/**
     * Description not provided
     *
     * @var string
     */
    protected $audioCodec;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $ingestServer;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $ingestViewers;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $lostPackets;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $nackPackets;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $recvPackets;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $sourceBitrate;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $sourcePing;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $streamTimeSeconds;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $vendorName;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $vendorVersion;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $videoCodec;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $videoHeight;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $videoWidth;
}
