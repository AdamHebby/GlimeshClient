<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * Client ID only
 */
final class OAuthFileAdapter implements AuthenticationAdapter
{
    private $clientId = null;
    private $clientSecret = null;
    private $jsonFile = null;

    private $auth = null;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $jsonFile
    ) {
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
        $this->jsonFile     = $jsonFile;

        if (file_exists($this->jsonFile)) {
            $this->auth = json_decode(file_get_contents($this->jsonFile));
        }
    }

    public function getAuthentication(): ?string
    {
        return $this->isExpired()
            ? null
            : "{$this->auth->token_type} {$this->auth->access_token}";
    }

    public function isExpired(): bool
    {
        if (!isset($this->auth) || !isset($this->auth->created_at)) {
            return false;
        }

        $dt = (new \DateTime($this->auth->created_at))->add(
            new \DateInterval('PT' . ($this->auth->expires_in ?? 0) . 'H')
        );

        return (new \DateTime()) >= $dt;
    }

    public function authenticate(\GuzzleHttp\Client $client): void
    {
        if ($this->isExpired() === false) {
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

    protected function saveAuth(): void
    {
        file_put_contents($this->jsonFile, json_encode($this->auth));
    }
}
