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
     */
    public function getAuthentication(): ?string;

    /**
     * Calls external resources with Guzzle if required
     *
     * @throws \Exception When Authentication fails
     */
    public function authenticate(\GuzzleHttp\Client $client): void;

    /**
     * Is the current authentication expired?
     */
    public function isExpired(): bool;
}
