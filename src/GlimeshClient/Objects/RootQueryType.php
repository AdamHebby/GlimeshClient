<?php

namespace GlimeshClient\Objects;

/**
 * Description not provided
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2022 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
class RootQueryType extends AbstractObjectModel
{
    /**
     * List all categories
     *
     * @var \ArrayObject<Category>
     */
    protected $categories;

    /**
     * Query individual category
     *
     * @var Category
     */
    protected $category;

    /**
     * Query individual channel
     *
     * @var Channel
     */
    protected $channel;

    /**
     * List all channels
     *
     * @var \ArrayObject<Channel>
     */
    protected $channels;

    /**
     * List all follows or followers
     *
     * @var \ArrayObject<Follower>
     */
    protected $followers;

    /**
     * Get yourself
     *
     * @var User
     */
    protected $myself;

    /**
     * List all subscribers or subscribees
     *
     * @var \ArrayObject<Sub>
     */
    protected $subscriptions;

    /**
     * Query individual user
     *
     * @var User
     */
    protected $user;

    /**
     * List all users
     *
     * @var \ArrayObject<User>
     */
    protected $users;
}
