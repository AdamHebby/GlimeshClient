<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * Type of Authentication to pass to the API
 */
interface AuthenticationAdapter
{
    /**
     * Should return locally stored auth if possible
     *
     * @return string|null
     */
    public function getAuthentication(): ?string;

    /**
     * Calls external resources with Guzzle if required
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return boolean
     */
    public function authenticate(\GuzzleHttp\Client $client): bool;
}
