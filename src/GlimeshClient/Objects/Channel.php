<?php

namespace GlimeshClient\Objects;

/**
 * A channel is a user's actual container for live streaming.
 */
class Channel extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var ArrayObject<ChannelBan>
     */
    protected $bans;

    /**
     * Description not provided
     *
     * @var Boolean
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
     * @var ArrayObject<ChatMessage>
     */
    protected $chatMessages;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $chatRulesHtml;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $chatRulesMd;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $disableHyperlinks;

    /**
     * Description not provided
     *
     * @var String
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
     * @var Boolean
     */
    protected $inaccessible;

    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $insertedAt;

    /**
     * The language a user can expect in the stream.
     *
     * @var String
     */
    protected $language;

    /**
     * If the streamer has flagged this channel as only appropriate for Mature Audiences.
     *
     * @var Boolean
     */
    protected $matureContent;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $minimumAccountAge;

    /**
     * Description not provided
     *
     * @var ArrayObject<ChannelModerationLog>
     */
    protected $moderationLogs;

    /**
     * Description not provided
     *
     * @var ArrayObject<ChannelModerator>
     */
    protected $moderators;

    /**
     * Description not provided
     *
     * @var Boolean
     */
    protected $requireConfirmedEmail;

    /**
     * Description not provided
     *
     * @var Boolean
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
     * @var String
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
     * @var ArrayObject<Tag>
     */
    protected $tags;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $thumbnail;

    /**
     * The title of the current stream, live or offline.
     *
     * @var String
     */
    protected $title;

    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;

    /**
     * Description not provided
     *
     * @var User
     */
    protected $user;
}
