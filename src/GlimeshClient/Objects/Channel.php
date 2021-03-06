<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;
use GlimeshClient\Objects\Enums\ChannelStatus;

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
    use ObjectModelTrait;

    /**
     * List of bans in the channel
     *
     * @var ?\ArrayObject<ChannelBan>
     */
    public readonly ?\ArrayObject $bans;

    /**
     * Toggle for blocking anyone from posting links
     *
     * @var ?bool
     */
    public readonly ?bool $blockLinks;

    /**
     * Category the current stream is in
     *
     * @var ?Category
     */
    public readonly ?Category $category;

    /**
     * List of chat messages sent in the channel
     *
     * @var ?\ArrayObject<ChatMessage>
     */
    public readonly ?\ArrayObject $chatMessages;

    /**
     * Chat rules in html
     *
     * @var ?string
     */
    public readonly ?string $chatRulesHtml;

    /**
     * Chat rules in markdown
     *
     * @var ?string
     */
    public readonly ?string $chatRulesMd;

    /**
     * Toggle for links automatically being clickable
     *
     * @var ?bool
     */
    public readonly ?bool $disableHyperlinks;

    /**
     * Hash-based Message Authentication Code for the stream
     *
     * @var ?string
     */
    public readonly ?string $hmacKey;

    /**
     * Unique channel identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Is the stream inaccessible?
     *
     * @var ?bool
     */
    public readonly ?bool $inaccessible;

    /**
     * Channel creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * The language a user can expect in the stream.
     *
     * @var ?string
     */
    public readonly ?string $language;

    /**
     * If the streamer has flagged this channel as only appropriate for Mature Audiences.
     *
     * @var ?bool
     */
    public readonly ?bool $matureContent;

    /**
     * Minimum account age length before chatting
     *
     * @var ?int
     */
    public readonly ?int $minimumAccountAge;

    /**
     * List of moderation events in the channel
     *
     * @var ?\ArrayObject<ChannelModerationLog>
     */
    public readonly ?\ArrayObject $moderationLogs;

    /**
     * List of moderators in the channel
     *
     * @var ?\ArrayObject<ChannelModerator>
     */
    public readonly ?\ArrayObject $moderators;

    /**
     * Toggle for requiring confirmed email before chatting
     *
     * @var ?bool
     */
    public readonly ?bool $requireConfirmedEmail;

    /**
     * Only show recent chat messages?
     *
     * @var ?bool
     */
    public readonly ?bool $showRecentChatMessagesOnly;

    /**
     * The current status of the channnel
     *
     * @var ?ChannelStatus
     */
    public readonly ?ChannelStatus $status;

    /**
     * If the channel is live, this will be the current Stream
     *
     * @var ?Stream
     */
    public readonly ?Stream $stream;

    /**
     * Current streams unique stream key
     *
     * @var ?string
     */
    public readonly ?string $streamKey;

    /**
     * User associated with the channel
     *
     * @var ?User
     */
    public readonly ?User $streamer;

    /**
     * Subcategory the current stream is in
     *
     * @var ?Subcategory
     */
    public readonly ?Subcategory $subcategory;

    /**
     * Tags associated with the channel
     *
     * @var ?\ArrayObject<Tag>
     */
    public readonly ?\ArrayObject $tags;

    /**
     * Current stream thumbnail
     *
     * @var ?string
     */
    public readonly ?string $thumbnail;

    /**
     * The title of the current stream, live or offline.
     *
     * @var ?string
     */
    public readonly ?string $title;

    /**
     * Channel updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;
}
