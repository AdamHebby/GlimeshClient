<?php

namespace GlimeshClient\Objects;

use GlimeshClient\Interfaces\ChatMessageToken;
use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Description not provided
 */
class TextToken extends AbstractObjectModel implements ChatMessageToken
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
}
