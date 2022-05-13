<?php

namespace GlimeshClient\Response;

use GlimeshClient\Traits\ObjectResolverTrait;
use GraphQL\Query;

class GlimeshWebsocketResponse extends AbstractGlimeshResponse
{
    use ObjectResolverTrait;

    public function __construct(
        protected Query $queryRequested,
        protected string $rawResponse
    ) {
        parent::__construct();
    }

    public function getRawResponseString(): string
    {
        return $this->rawResponse;
    }
}
