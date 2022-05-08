<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Traits\ObjectModelTrait;

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
    use ObjectModelTrait;

    /**
     * List all categories
     *
     * @var ?\ArrayObject<Category>
     */
    public readonly ?\ArrayObject $categories;

    /**
     * Query individual category
     *
     * @var ?Category
     */
    public readonly ?Category $category;

    /**
     * Query individual channel
     *
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * List all channels
     *
     * @var ?\ArrayObject<Channel>
     */
    public readonly ?\ArrayObject $channels;

    /**
     * List all follows or followers
     *
     * @var ?\ArrayObject<Follower>
     */
    public readonly ?\ArrayObject $followers;

    /**
     * Get yourself
     *
     * @var ?User
     */
    public readonly ?User $myself;

    /**
     * List all subscribers or subscribees
     *
     * @var ?\ArrayObject<Sub>
     */
    public readonly ?\ArrayObject $subscriptions;

    /**
     * Query individual user
     *
     * @var ?User
     */
    public readonly ?User $user;

    /**
     * List all users
     *
     * @var ?\ArrayObject<User>
     */
    public readonly ?\ArrayObject $users;
}
