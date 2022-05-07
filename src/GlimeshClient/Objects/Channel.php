<?php

namespace GlimeshClient\Objects;

/**
 * A channel is a user's actual container for live streaming.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Channel extends AbstractObjectModel
{
    /**
     * List of bans in the channel
     *
     * @var \ArrayObject<ChannelBan>
     */
    protected $bans;

    /**
     * Toggle for blocking anyone from posting links
     *
     * @var boolean
     */
    protected $blockLinks;

    /**
     * Category the current stream is in
     *
     * @var Category
     */
    protected $category;

    /**
     * List of chat messages sent in the channel
     *
     * @var \ArrayObject<ChatMessage>
     */
    protected $chatMessages;

    /**
     * Chat rules in html
     *
     * @var string
     */
    protected $chatRulesHtml;

    /**
     * Chat rules in markdown
     *
     * @var string
     */
    protected $chatRulesMd;

    /**
     * Toggle for links automatically being clickable
     *
     * @var boolean
     */
    protected $disableHyperlinks;

    /**
     * Hash-based Message Authentication Code for the stream
     *
     * @var string
     */
    protected $hmacKey;

    /**
     * Unique channel identifier
     *
     * @var string
     */
    protected $id;

    /**
     * Is the stream inaccessible?
     *
     * @var boolean
     */
    protected $inaccessible;

    /**
     * Channel creation date
     *
     * @var \DateTime
     */
    protected $insertedAt;

    /**
     * The language a user can expect in the stream.
     *
     * @var string
     */
    protected $language;

    /**
     * If the streamer has flagged this channel as only appropriate for Mature Audiences.
     *
     * @var boolean
     */
    protected $matureContent;

    /**
     * Minimum account age length before chatting
     *
     * @var int
     */
    protected $minimumAccountAge;

    /**
     * List of moderation events in the channel
     *
     * @var \ArrayObject<ChannelModerationLog>
     */
    protected $moderationLogs;

    /**
     * List of moderators in the channel
     *
     * @var \ArrayObject<ChannelModerator>
     */
    protected $moderators;

    /**
     * Toggle for requiring confirmed email before chatting
     *
     * @var boolean
     */
    protected $requireConfirmedEmail;

    /**
     * Only show recent chat messages?
     *
     * @var boolean
     */
    protected $showRecentChatMessagesOnly;

    /**
     * The current status of the channnel
     *
     * @var ChannelStatus
     */
    protected $status;

    /**
     * If the channel is live, this will be the current Stream
     *
     * @var Stream
     */
    protected $stream;

    /**
     * Current streams unique stream key
     *
     * @var string
     */
    protected $streamKey;

    /**
     * User associated with the channel
     *
     * @var User
     */
    protected $streamer;

    /**
     * Subcategory the current stream is in
     *
     * @var Subcategory
     */
    protected $subcategory;

    /**
     * Tags associated with the channel
     *
     * @var \ArrayObject<Tag>
     */
    protected $tags;

    /**
     * Current stream thumbnail
     *
     * @var string
     */
    protected $thumbnail;

    /**
     * The title of the current stream, live or offline.
     *
     * @var string
     */
    protected $title;

    /**
     * Channel updated date
     *
     * @var \DateTime
     */
    protected $updatedAt;
}
