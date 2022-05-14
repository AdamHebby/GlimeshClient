<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A stream is a single live stream in, either current or historical.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Stream extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * The category the current stream is in
     *
     * @var ?Category
     */
    public readonly ?Category $category;

    /**
     * Channel running with the stream
     *
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * Concurrent viewers during last snapshot
     *
     * @var ?int
     */
    public readonly ?int $countViewers;

    /**
     * Datetime of when the stream was ended, or null if still going
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $endedAt;

    /**
     * Unique stream identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Stream created date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * Current stream metadata
     *
     * @var ?\ArrayObject<StreamMetadata>
     */
    public readonly ?\ArrayObject $metadata;

    /**
     * Peak concurrent viewers
     *
     * @var ?int
     */
    public readonly ?int $peakViewers;

    /**
     * Datetime of when the stream was started
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $startedAt;

    /**
     * Thumbnail URL of the stream
     *
     * @var ?string
     */
    public readonly ?string $thumbnailUrl;

    /**
     * The title of the channel when the stream was started
     *
     * @var ?string
     */
    public readonly ?string $title;

    /**
     * Stream updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;
}
