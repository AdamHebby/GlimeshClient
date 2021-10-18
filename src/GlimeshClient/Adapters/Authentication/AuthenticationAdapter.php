<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * Type of Authentication to pass to the API
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
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
     * @return void
     */
    public function authenticate(\GuzzleHttp\Client $client): void;

    /**
     * Is the current authentication expired?
     *
     * @return boolean
     */
    public function isExpired(): bool;
}
