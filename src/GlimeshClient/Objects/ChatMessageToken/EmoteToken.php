<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Interfaces\ChatMessageToken;
use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Description not provided
 */
class EmoteToken extends AbstractObjectModel implements ChatMessageToken
{
    /**
     * Description not provided
     *
     * @var string
     */
    protected $src;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $text;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $type;

    /**
     * Description not provided
     *
     * @var string
     */
    protected $url;
}
