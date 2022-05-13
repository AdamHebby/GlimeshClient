<?php

namespace GlimeshClient\Response;

use GlimeshClient\Traits\ObjectResolverTrait;
use GraphQL\Query;
use GuzzleHttp\Psr7\Response;

class GlimeshApiResponse extends AbstractGlimeshResponse
{
    use ObjectResolverTrait;

    public function __construct(
        protected Query $queryRequested,
        protected Response $guzzleResponse
    ) {
        $this->rawResponse = $this->guzzleResponse->getBody()->getContents();
        parent::__construct();
    }

    public function getRawResponseString(): string
    {
        return $this->rawResponse;
    }

    public function getGuzzleResponse(): Response
    {
        return $this->guzzleResponse;
    }
}
