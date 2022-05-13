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
class RootSubscriptionType extends AbstractObjectModel
{
    use ObjectModelTrait;

    /**
     * Description not provided
     *
     * @var ?\ArrayObject<Channel>
     */
    public readonly ?\ArrayObject $channel;

    /**
     * Description not provided
     *
     * @var ?\ArrayObject<ChatMessage>
     */
    public readonly ?\ArrayObject $chatMessage;

    /**
     * Description not provided
     *
     * @var ?\ArrayObject<Follower>
     */
    public readonly ?\ArrayObject $followers;
}
