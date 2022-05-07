<?php

namespace GlimeshClient\Objects;

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
    /**
     * User Avatar
     *
     * @var string
     */
    protected $avatar;

    /**
     * URL to the user's avatar
     *
     * @var string
     */
    protected $avatarUrl;

    /**
     * Datetime the user confirmed their email address
     *
     * @var \DateTime
     */
    protected $confirmedAt;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $countFollowers;

    /**
     * Description not provided
     *
     * @var int
     */
    protected $countFollowing;

    /**
     * Exactly the same as the username, but with casing the user prefers
     *
     * @var string
     */
    protected $displayname;

    /**
     * A list of users who are following you
     *
     * @var \ArrayObject<Follower>
     */
    protected $followers;

    /**
     * A list of users who you are following
     *
     * @var \ArrayObject<Follower>
     */
    protected $following;

    /**
     * Unique User identifier
     *
     * @var string
     */
    protected $id;

    /**
     * HTML version of the user's profile, should be safe for rendering directly
     *
     * @var string
     */
    protected $profileContentHtml;

    /**
     * Markdown version of the user's profile
     *
     * @var string
     */
    protected $profileContentMd;

    /**
     * Qualified URL for the user's Discord server
     *
     * @var string
     */
    protected $socialDiscord;

    /**
     * Qualified URL for the user's Guilded server
     *
     * @var string
     */
    protected $socialGuilded;

    /**
     * Qualified URL for the user's Instagram account
     *
     * @var string
     */
    protected $socialInstagram;

    /**
     * Qualified URL for the user's YouTube account
     *
     * @var string
     */
    protected $socialYoutube;

    /**
     * A list of linked social accounts for the user
     *
     * @var \ArrayObject<UserSocial>
     */
    protected $socials;

    /**
     * Lowercase user identifier
     *
     * @var string
     */
    protected $username;

    /**
     * YouTube Intro URL for the user's profile
     *
     * @var string
     */
    protected $youtubeIntroUrl;
}
