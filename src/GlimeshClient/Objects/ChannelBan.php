<?php

namespace GlimeshClient\Objects;

/**
 * A channel timeout or ban
 */
class ChannelBan extends AbstractObjectModel
{
    /**
     * Description not provided
     *
     * @var Channel
     */
    protected $channel;
    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $expiresAt;
    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $insertedAt;
    /**
     * Description not provided
     *
     * @var string
     */
    protected $reason;
    /**
     * Description not provided
     *
     * @var DateTime
     */
    protected $updatedAt;
    /**
     * Description not provided
     *
     * @var User
     */
    protected $user;

}
