<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * OAuth File Adapter Authentication, uses a JSON file to update auth, will keep updating
 * the file
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
final class OAuthFileAdapter implements AuthenticationAdapter
{
    /**
     * Stored Authentication object
     *
     * @var object
     */
    private $auth;

    /**
     * Constructor for OAuth
     *
     * @param string $clientId Your Glimesh Client ID
     * @param string $clientSecret Your Glimesh Client Secret
     * @param string $jsonFile JSON File path to store auth details in
     */
    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly string $jsonFile
    ) {
        if (file_exists($this->jsonFile)) {
            $this->auth = json_decode(file_get_contents($this->jsonFile));
        }
    }

    /**
     * @inheritDoc
     */
    public function getAuthentication(): ?string
    {
        return $this->isExpired()
            ? null
            : "{$this->auth->token_type} {$this->auth->access_token}";
    }

    /**
     * Get the current access token
     */
    public function getAccessToken(): string
    {
        return $this->auth->access_token;
    }

    /**
     * @inheritDoc
     */
    public function isExpired(): bool
    {
        // No / invalid auth stored
        if (empty($this->auth) || !isset($this->auth->created_at)) {
            return true;
        }

        // Calculate the expiration date
        $dt = (new \DateTime($this->auth->created_at))->add(
            new \DateInterval('PT' . ($this->auth->expires_in ?? 0) . 'S')
        );

        // expired?
        return (new \DateTime()) >= $dt;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(\GuzzleHttp\Client $client): void
    {
        if ($this->isExpired()) {
            $res = $client->request('POST', 'https://glimesh.tv/api/oauth/token', [
                'query' => [
                    'grant_type'    => 'client_credentials',
                    'client_id'     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]
            ]);

            if ($res->getStatusCode() !== 200) {
                throw new \Exception('OAuth Request failed');
            }

            $this->auth = json_decode($res->getBody());
            $this->saveAuth();
        }
    }

    /**
     * Store the Auth details into a JSON file
     */
    protected function saveAuth(): void
    {
        if (!empty($this->auth)) {
            file_put_contents($this->jsonFile, json_encode($this->auth));
        }
    }
}
