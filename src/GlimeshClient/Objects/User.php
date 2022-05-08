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
 */
class User extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * User Avatar
     *
     * @var ?string
     */
    public readonly ?string $avatar;

    /**
     * URL to the user's avatar
     *
     * @var ?string
     */
    public readonly ?string $avatarUrl;

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
     * A list of users who are following you
     *
     * @var ?\ArrayObject<Follower>
     */
    public readonly ?\ArrayObject $followers;

    /**
     * A list of users who you are following
     *
     * @var ?\ArrayObject<Follower>
     */
    public readonly ?\ArrayObject $following;

    /**
     * Unique User identifier
     *
     * @var ?string
     */
    public readonly ?string $id;

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
