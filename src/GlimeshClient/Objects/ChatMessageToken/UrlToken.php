<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Interfaces\ChatMessageToken;
use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Description not provided
 */
class UrlToken extends AbstractObjectModel implements ChatMessageToken
{
    /**
     * Description not provided
     *
     * @var String
     */
    protected $text;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $type;

    /**
     * Description not provided
     *
     * @var String
     */
    protected $url;
}
