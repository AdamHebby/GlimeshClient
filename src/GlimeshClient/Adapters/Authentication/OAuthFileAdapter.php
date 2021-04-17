<?php

namespace GlimeshClient\Adapters\Authentication;

/**
 * Client ID only
 */
final class OAuthFileAdapter implements AuthenticationAdapter
{
    private $clientId = null;
    private $clientCode = null;
    private $clientSecret = null;
    private $redirectUrl = null;
    private $jsonFile = null;
    private $callBack = null;

    private $auth = null;

    public function __construct(
        string $clientId,
        string $clientCode,
        string $clientSecret,
        string $redirectUrl,
        string $jsonFile
    ) {
        $this->clientId     = $clientId;
        $this->clientCode   = $clientCode;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl  = $redirectUrl;
        $this->jsonFile     = $jsonFile;

        if (file_exists($this->jsonFile)) {
            $this->auth = json_decode(file_get_contents($this->jsonFile));
        }
    }

    public function setCallback(callable $fn): void
    {
        $this->callBack = $fn;
    }

    public function getAuthentication(): ?string
    {
        if (!isset($this->auth) || !isset($this->auth->access_token)) return null;

        return "{$this->auth->token_type} {$this->auth->access_token}";
    }

    public function authenticate(\GuzzleHttp\Client $client): bool
    {
        if ($this->auth->access_token === null || !isset($this->auth->created_at) || isset($this->auth->error)) {
            $res = $client->request('POST', 'https://glimesh.tv/api/oauth/token', [
                'query' => [
                    'grant_type'    => 'authorization_code',
                    'redirect_uri'  => $this->redirectUrl,
                    'code'          => $this->clientCode,
                    'client_id'     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]
            ]);

            if ($res->getStatusCode() !== 200) {
                throw new \Exception('OAuth Request failed');
            }

            $this->auth = json_decode($res->getBody());
            $this->saveAuth();

            return true;
        }

        if (isset($this->auth->created_at)) {
            $dt = (new \DateTime($this->auth->created_at))->add(new \DateInterval('PT5H'));

            if ((new \DateTime()) >= $dt) {
                $this->renewAccessToken($client);
            }
            return true;
        }

        return false;
    }

    protected function saveAuth(): void
    {
        file_put_contents($this->jsonFile, json_encode($this->auth));

        if ($this->callBack !== null) $this->$callBack($this->auth);
    }

    protected function renewAccessToken(\GuzzleHttp\Client $client): void
    {
        $res = $client->request('POST', 'https://glimesh.tv/api/oauth/token', [
            'query' => [
                'grant_type'    => 'refresh_token',
                'redirect_uri'  => $this->redirectUrl,
                'refresh_token' => $this->auth->refresh_token,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]
        ]);

        if ($res->getStatusCode() !== 200) {
            throw new \Exception('OAuth Token Refresh Request failed');
        }

        $this->auth = json_decode($res->getBody());
        $this->saveAuth();
    }
}
