<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\OAuth\ResourceOwner;

use Devtronic\OAuth\AccessToken;
use Devtronic\OAuth\Exception\InvalidScopesException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

abstract class OAuth2ResourceOwner
{
    /**
     * OAuth Client ID
     * @var string
     */
    protected $clientId = '';

    /**
     * OAuth Client Secret
     * @var string
     */
    protected $clientSecret = '';

    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = '';

    /**
     * The redirect URL for authorizing
     * @var string
     */
    protected $redirectUrl = '';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = '';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [];

    /**
     * The character for imploding the scopes. In most cases this is a space
     * @var string
     */
    protected $scopeSeparator = ' ';

    public function __construct($clientId, $clientSecret, $redirectUrl)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Returns the URL for authorizing
     *
     * @param array $scopes
     * @return string
     *
     * @throws InvalidScopesException If one or more scopes was not found
     */
    public function getAuthorizeUrl($scopes = [])
    {
        $invalidScopes = $this->checkScopes($scopes);
        if (count($invalidScopes) > 0) {
            throw new InvalidScopesException($invalidScopes);
        }

        return sprintf('%s?%s', $this->authorizeUrl, http_build_query([
            'client_id' => $this->clientId,
            'scope' => implode($this->scopeSeparator, $scopes),
            'state' => substr(md5(uniqid()), 0, 8),
            'redirect_uri' => $this->redirectUrl,
            'response_type' => 'code'
        ]));
    }

    /**
     * @param string[] $scopes The scopes
     * @param string $authCode The code from the authorize flow
     *
     * @return AccessToken The Access Token
     * @throws ClientException If the request fails
     */
    public function getAccessToken($scopes, $authCode)
    {
        $client = new Client(['verify' => false]);
        $res = null;

        $params = [
            'redirect_uri' => $this->redirectUrl,
            'grant_type' => 'authorization_code',
            'code' => $authCode
        ];

        if (count($scopes) > 0) {
            $params['scope'] = implode($this->scopeSeparator, $scopes);
        }

        $params = $this->handleGetAccessTokenParameters($params);

        /** @throws ClientException */
        $res = $client->post($this->tokenUrl, [
            'form_params' => $params,
            'auth' => [
                $this->clientId,
                $this->clientSecret
            ]
        ]);

        $token = $this->fetchResponse($res->getBody()->getContents(), $scopes);

        return $token;
    }

    public function fetchResponse($tokenData, $scopes)
    {
        $tokenData = json_decode($tokenData, true);
        $expireDate = null;
        if (isset($tokenData['expires_in'])) {
            $expireDate = new \DateTime();
            $expireDate->setTimestamp(time() + $tokenData['expires_in']);
        }

        $token = new AccessToken();
        $token
            ->setScopes($scopes)
            ->setToken($tokenData['access_token'])
            ->setExpires($expireDate);

        if (isset($tokenData['token_type'])) {
            $token->setType($tokenData['token_type']);
        }

        if (isset($tokenData['refresh_token'])) {
            $token->setRefreshToken($tokenData['refresh_token']);
        }

        return $token;
    }

    /**
     * Handles the parameters before the getAccessToken-Request
     *
     * @param array $parmeters The Parameters
     * @return array The Parameters
     */
    public function handleGetAccessTokenParameters($parmeters)
    {
        return $parmeters;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function addScope($name, $description)
    {
        if (!isset($this->scopes[$name])) {
            $this->scopes[$name] = $description;
        }
    }

    protected function checkScopes($givenScopes)
    {
        $invalidScopes = [];
        foreach ($givenScopes as $scope) {
            if (!isset($this->scopes[$scope])) {
                $invalidScopes[] = $scope;
            }
        }
        return $invalidScopes;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return OAuth2ResourceOwner
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return OAuth2ResourceOwner
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @param string $redirectUrl
     * @return OAuth2ResourceOwner
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }
}
