<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * Description not provided
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class RootMutationType extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Ban a user from a chat channel.
     *
     * @var ?ChannelModerationLog
     */
    public readonly ?ChannelModerationLog $banUser;

    /**
     * Create a chat message
     *
     * @var ?ChatMessage
     */
    public readonly ?ChatMessage $createChatMessage;

    /**
     * Deletes a specific chat message from channel.
     *
     * @var ?ChannelModerationLog
     */
    public readonly ?ChannelModerationLog $deleteMessage;

    /**
     * End a stream
     *
     * @var ?Stream
     */
    public readonly ?Stream $endStream;

    /**
     * Update a stream's metadata
     *
     * @var ?StreamMetadata
     */
    public readonly ?StreamMetadata $logStreamMetadata;

    /**
     * Long timeout (15 minutes) a user from a chat channel.
     *
     * @var ?ChannelModerationLog
     */
    public readonly ?ChannelModerationLog $longTimeoutUser;

    /**
     * Short timeout (5 minutes) a user from a chat channel.
     *
     * @var ?ChannelModerationLog
     */
    public readonly ?ChannelModerationLog $shortTimeoutUser;

    /**
     * Start a stream
     *
     * @var ?Stream
     */
    public readonly ?Stream $startStream;

    /**
     * Unban a user from a chat channel.
     *
     * @var ?ChannelModerationLog
     */
    public readonly ?ChannelModerationLog $unbanUser;

    /**
     * Update a stream's thumbnail
     *
     * @var ?Stream
     */
    public readonly ?Stream $uploadStreamThumbnail;
}
