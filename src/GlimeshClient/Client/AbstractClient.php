<?php

namespace GlimeshClient\Client;

use GlimeshClient\Adapters\Authentication\AuthenticationAdapter;
use GlimeshClient\Traits\ObjectResolverTrait;

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
    use ObjectResolverTrait;

    /**
     * Glimesh URL
     */
    public final const GLIMESH_URL = 'https://glimesh.tv';

    /**
     * Current GuzzleClient used to interact with the API
     *
     * @var \GuzzleHttp\Client
     */
    protected $guzzleClient = null;

    /**
     * Current Authentication Adapter in use
     *
     * @var AuthenticationAdapter
     */
    protected $authAdapter = null;

    /**
     * Current Logger
     *
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger = null;

    /**
     * Get a multiline error string from an error array item returned from the API
     *
     * @param array $glimeshError
     */
    protected static function getAllErrorStrings(array $glimeshErrors): string
    {
        return implode("\n", (array_map(function(array $error) {
            return self::getErrorString($error);
        }, $glimeshErrors ?? [])));
    }

    /**
     * Get an error string from an error array item returned from the API
     */
    protected static function getErrorString(array $glimeshError): string
    {
        return sprintf(
            "Glimesh API Error, Col %s Line %s: %s",
            $glimeshError['locations'][0]['column'],
            $glimeshError['locations'][0]['line'],
            $glimeshError['message'],
        );
    }

    /**
     * Returns a query in a pretty printed form
     */
    public static function prettyPrintQuery(string $string): string
    {
        $lines = explode("\n", $string);
        $t = "    ";
        $ct = 0;
        foreach ($lines as $index => $line) {
            if (substr($line, -1, 1) === '{') {
                $ct += 1;
            } elseif (substr($line, -1, 1) === '}') {
                $ct -= 1;
            }

            $lines[$index] = str_repeat($t, $ct) . $lines[$index];
        }

        return implode("\n", $lines) . "\n";
    }
}
