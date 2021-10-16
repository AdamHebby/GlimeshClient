<?php

namespace GlimeshClient\Objects;

/**
 * A channel is a user's actual container for live streaming.
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class Channel extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var \ArrayObject<ChannelBan>
     */
    protected $bans;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $blockLinks;

    /**
     * Description not provided
     *
     * @var Category
     */
    protected $category;

    /**
     * Description not provided
     *
     * @var \ArrayObject<ChatMessage>
     */
    protected $chatMessages;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $chatRulesHtml;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $chatRulesMd;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $disableHyperlinks;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $hmacKey;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $inaccessible;

    /**
     * Description not provided
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
     * Description not provided
     *
     * @var int
     */
    protected $minimumAccountAge;

    /**
     * Description not provided
     *
     * @var \ArrayObject<ChannelModerationLog>
     */
    protected $moderationLogs;

    /**
     * Description not provided
     *
     * @var \ArrayObject<ChannelModerator>
     */
    protected $moderators;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $requireConfirmedEmail;

    /**
     * Description not provided
     *
     * @var boolean
     */
    protected $showRecentChatMessagesOnly;

    /**
     * Description not provided
     *
     * @var ChannelStatus
     */
    protected $status;

    /**
     * Description not provided
     *
     * @var Stream
     */
    protected $stream;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $streamKey;

    /**
     * Description not provided
     *
     * @var User
     */
    protected $streamer;

    /**
     * Description not provided
     *
     * @var Subcategory
     */
    protected $subcategory;

    /**
     * Description not provided
     *
     * @var \ArrayObject<Tag>
     */
    protected $tags;

    /**
     * Description not provided
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
     * Description not provided
     *
     * @var \DateTime
     */
    protected $updatedAt;
}
