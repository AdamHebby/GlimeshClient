<?php

namespace GlimeshClient\Objects;

/**
 * Description not provided
 */
class RootMutationType extends AbstractObjectModel
{
    /**
     * Ban a user from a chat channel.
     *
     * @var ChannelModerationLog
     */
    protected $banUser;

    /**
     * Create a chat message
     *
     * @var ChatMessage
     */
    protected $createChatMessage;

    /**
     * Deletes a specific chat message from channel.
     *
     * @var ChannelModerationLog
     */
    protected $deleteMessage;

    /**
     * End a stream
     *
     * @var Stream
     */
    protected $endStream;

    /**
     * Update a stream's metadata
     *
     * @var StreamMetadata
     */
    protected $logStreamMetadata;

    /**
     * Long timeout (15 minutes) a user from a chat channel.
     *
     * @var ChannelModerationLog
     */
    protected $longTimeoutUser;

    /**
     * Short timeout (5 minutes) a user from a chat channel.
     *
     * @var ChannelModerationLog
     */
    protected $shortTimeoutUser;

    /**
     * Start a stream
     *
     * @var Stream
     */
    protected $startStream;

    /**
     * Unban a user from a chat channel.
     *
     * @var ChannelModerationLog
     */
    protected $unbanUser;

    /**
     * Update a stream's thumbnail
     *
     * @var Stream
     */
    protected $uploadStreamThumbnail;
}
