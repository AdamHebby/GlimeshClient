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
     * @var channelmoderationlog
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
     * @var channelmoderationlog
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
     * @var streammetadata
     */
    protected $logStreamMetadata;

    /**
     * Long timeout (15 minutes) a user from a chat channel.
     *
     * @var channelmoderationlog
     */
    protected $longTimeoutUser;

    /**
     * Short timeout (5 minutes) a user from a chat channel.
     *
     * @var channelmoderationlog
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
     * @var channelmoderationlog
     */
    protected $unbanUser;

    /**
     * Update a stream's thumbnail
     *
     * @var Stream
     */
    protected $uploadStreamThumbnail;
}
