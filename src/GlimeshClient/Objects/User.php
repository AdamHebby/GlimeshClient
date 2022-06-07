<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

/**
 * A user of Glimesh, can be a streamer, a viewer or both!
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 * @generated 2022-06-07
 */
class User extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Description not provided
     *
     * @var ?bool
     */
    public readonly ?bool $allowGlimeshNewsletterEmails;

    /**
     * Description not provided
     *
     * @var ?bool
     */
    public readonly ?bool $allowLiveSubscriptionEmails;

    /**
     * URL to the user's avatar
     *
     * @var ?string
     */
    public readonly ?string $avatarUrl;

    /**
     * A user's channel, if they have one
     *
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * Datetime the user confirmed their email address
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $confirmedAt;

    /**
     * Description not provided
     *
     * @var ?int
     */
    public readonly ?int $countFollowers;

    /**
     * Description not provided
     *
     * @var ?int
     */
    public readonly ?int $countFollowing;

    /**
     * Exactly the same as the username, but with casing the user prefers
     *
     * @var ?string
     */
    public readonly ?string $displayname;

    /**
     * Email for the user, hidden behind a scope
     *
     * @var ?string
     */
    public readonly ?string $email;

    /**
     * Description not provided
     *
     * @var ?\ArrayObject<Follower>
     */
    public readonly ?\ArrayObject $followers;

    /**
     * Description not provided
     *
     * @var ?\ArrayObject<Follower>
     */
    public readonly ?\ArrayObject $following;

    /**
     * Shortcut to a user's followed channels
     *
     * @var ?\ArrayObject<Channel>
     */
    public readonly ?\ArrayObject $followingLiveChannels;

    /**
     * Unique User identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

    /**
     * Account creation date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $insertedAt;

    /**
     * HTML version of the user's profile, should be safe for rendering directly
     *
     * @var ?string
     */
    public readonly ?string $profileContentHtml;

    /**
     * Markdown version of the user's profile
     *
     * @var ?string
     */
    public readonly ?string $profileContentMd;

    /**
     * Qualified URL for the user's Discord server
     *
     * @var ?string
     */
    public readonly ?string $socialDiscord;

    /**
     * Qualified URL for the user's Guilded server
     *
     * @var ?string
     */
    public readonly ?string $socialGuilded;

    /**
     * Qualified URL for the user's Instagram account
     *
     * @var ?string
     */
    public readonly ?string $socialInstagram;

    /**
     * Qualified URL for the user's YouTube account
     *
     * @var ?string
     */
    public readonly ?string $socialYoutube;

    /**
     * A list of linked social accounts for the user
     *
     * @var ?\ArrayObject<UserSocial>
     */
    public readonly ?\ArrayObject $socials;

    /**
     * The primary role the user performs on the Glimesh team
     *
     * @var ?string
     */
    public readonly ?string $teamRole;

    /**
     * Account last updated date
     *
     * @var ?\DateTime
     */
    public readonly ?\DateTime $updatedAt;

    /**
     * Lowercase user identifier
     *
     * @var ?string
     */
    public readonly ?string $username;

    /**
     * YouTube Intro URL for the user's profile
     *
     * @var ?string
     */
    public readonly ?string $youtubeIntroUrl;
}
