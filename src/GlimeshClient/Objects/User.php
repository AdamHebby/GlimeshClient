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
     * @var String
     */
    protected $avatar;

    /**
     * Description not provided
     *
     * @var String
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
     * @var Int
     */
    protected $countFollowers;

    /**
     * Description not provided
     *
     * @var Int
     */
    protected $countFollowing;

    /**
     * Exactly the same as the username, but with casing the user prefers
     *
     * @var String
     */
    protected $displayname;

    /**
     * A list of users who are following you
     *
     * @var ArrayObject<Follower>
     */
    protected $followers;

    /**
     * A list of users who you are following
     *
     * @var ArrayObject<Follower>
     */
    protected $following;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $id;

    /**
     * HTML version of the user's profile, should be safe for rendering directly
     *
     * @var String
     */
    protected $profileContentHtml;

    /**
     * Markdown version of the user's profile
     *
     * @var String
     */
    protected $profileContentMd;

    /**
     * Qualified URL for the user's Discord server
     *
     * @var String
     */
    protected $socialDiscord;

    /**
     * Qualified URL for the user's Guilded server
     *
     * @var String
     */
    protected $socialGuilded;

    /**
     * Qualified URL for the user's Instagram account
     *
     * @var String
     */
    protected $socialInstagram;

    /**
     * Qualified URL for the user's Twitter account
     *
     * @var String
     */
    protected $socialTwitter;

    /**
     * Qualified URL for the user's YouTube account
     *
     * @var String
     */
    protected $socialYoutube;

    /**
     * A list of linked social accounts for the user
     *
     * @var ArrayObject<UserSocial>
     */
    protected $socials;

    /**
     * Lowercase user identifier
     *
     * @var String
     */
    protected $username;

    /**
     * YouTube Intro URL for the user's profile
     *
     * @var String
     */
    protected $youtubeIntroUrl;
}
