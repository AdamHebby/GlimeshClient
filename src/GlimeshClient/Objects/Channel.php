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
     * @var ChannelBan
     */
    protected $bans;
    /**
     * Description not provided
     *
     * @var bool
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
     * @var ChatMessage
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
     * @var bool
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
     * @var int
     */
    protected $id;
    /**
     * Description not provided
     *
     * @var bool
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
     * @var string
     */
    protected $language;
    /**
     * Description not provided
     *
     * @var int
     */
    protected $minimumAccountAge;
    /**
     * Description not provided
     *
     * @var ChannelModerationLog
     */
    protected $moderationLogs;
    /**
     * Description not provided
     *
     * @var ChannelModerator
     */
    protected $moderators;
    /**
     * Description not provided
     *
     * @var bool
     */
    protected $requireConfirmedEmail;
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
     * @var Tag
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
     * @var DateTime
     */
    protected $updatedAt;

}
