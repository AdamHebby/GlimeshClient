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
     * @var ?Channel
     */
    public readonly ?Channel $channel;

    /**
     * Description not provided
     *
     * @var ?ChatMessage
     */
    public readonly ?ChatMessage $chatMessage;

    /**
     * Description not provided
     *
     * @var ?Follower
     */
    public readonly ?Follower $followers;
}
