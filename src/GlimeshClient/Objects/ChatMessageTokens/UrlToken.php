<?php

namespace GlimeshClient\Objects\ChatMessageToken;

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
