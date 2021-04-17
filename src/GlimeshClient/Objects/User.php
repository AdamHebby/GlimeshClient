<?php

namespace GlimeshClient\Objects;

/**
 * A user of Glimesh, can be a streamer, a viewer or both!
 */
class User extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var string
     */
    protected $avatar;
    /**
     * Description not provided
     *
     * @var string
     */
    protected $avatarUrl;
    /**
     * Description not provided
     *
     * @var DateTime
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
     * @var Follower
     */
    protected $followers;
    /**
     * A list of users who you are following
     *
     * @var Follower
     */
    protected $following;
    /**
     * Description not provided
     *
     * @var int
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
     * @var UserSocial
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
