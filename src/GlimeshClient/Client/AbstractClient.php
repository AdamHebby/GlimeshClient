<?php

namespace GlimeshClient\Client;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GlimeshClient\Traits\ObjectResolverTrait;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

/**
 * Glimesh Abstract common Client
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
abstract class AbstractClient
{
    /**
     * Glimesh URL
     */
    public final const GLIMESH_URL = 'https://glimesh.tv';

    /**
     * Current GuzzleClient used to interact with the API
     */
    protected ?Client $guzzleClient = null;

    /**
     * Current Authentication Adapter in use
     */
    protected ?AuthenticationAdapter $authAdapter = null;

    /**
     * Current Logger
     */
    protected ?LoggerInterface $logger = null;
}
