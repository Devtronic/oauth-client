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
use GuzzleHttp\Client;

abstract class OAuth1ResourceOwner
{
    /**
     * OAuth 1.0 Consumer Key
     * @var string
     */
    protected $consumerKey = '';

    /**
     * OAuth 1.0 Consumer Secret
     * @var string
     */
    protected $consumerSecret = '';

    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = '';

    /**
     * The URL for request_token
     * @var string
     */
    protected $requestTokenUrl = '';

    /**
     * The URL for access_token
     * @var string
     */
    protected $accessTokenUrl = '';


    /**
     * The redirect URL for authorizing
     * @var string
     */
    protected $redirectUrl = '';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [];

    public function __construct($consumerKey, $consumerSecret, $redirectUrl)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->redirectUrl = $redirectUrl;
    }

    public function getAuthorizeUrl()
    {
        $authParameters = [
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_signature_method' => "HMAC-SHA1",
            'oauth_timestamp' => time(),
            'oauth_nonce' => substr(md5(uniqid()), 0, 6),
            'oauth_version' => "1.0",
        ];

        if ($this->redirectUrl != '') {
            $authParameters['oauth_callback'] = $this->redirectUrl;
        }

        $authParameters['oauth_signature'] = $this->getSignature(
            'GET',
            $this->requestTokenUrl,
            $authParameters,
            ''
        );

        $client = new Client(['verify' => false]);
        $res = $client->request('GET', $this->requestTokenUrl, [
            'headers' => [
                'Authorization' => 'OAuth ' . $this->buildOAuthHeader($authParameters)
            ]
        ]);

        $tokenResult = [];
        parse_str($res->getBody()->getContents(), $tokenResult);

        return $this->authorizeUrl . '?' . http_build_query([
                'oauth_token' => $tokenResult['oauth_token'],
            ]);
    }

    public function getAccessToken($oAuthToken, $oAuthVerifier)
    {
        $authParameters = [
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_signature_method' => "HMAC-SHA1",
            'oauth_timestamp' => time(),
            'oauth_nonce' => substr(md5(uniqid()), 0, 6),
            'oauth_version' => "1.0",
            'oauth_token' => $oAuthToken,
            'oauth_verifier' => $oAuthVerifier,
        ];

        if ($this->redirectUrl != '') {
            $authParameters['oauth_callback'] = $this->redirectUrl;
        }

        $authParameters['oauth_signature'] = $this->getSignature(
            'POST',
            $this->accessTokenUrl,
            $authParameters,
            ''
        );

        $client = new Client(['verify' => false]);
        $res = $client->request('POST', $this->accessTokenUrl, [
            'headers' => [
                'Authorization' => 'OAuth ' . $this->buildOAuthHeader($authParameters)
            ],
            'form_params' => [
                'oauth_verifier' => $oAuthVerifier,
            ]
        ]);

        $tokenResult = [];
        parse_str($res->getBody()->getContents(), $tokenResult);


        $token = new AccessToken();
        $token
            ->setToken($tokenResult['oauth_token'])
            ->setSecret($tokenResult['oauth_token_secret'])
            ->setType('OAuth');

        return $token;
    }

    public function getSignature($requestMethod, $url, $parameters, $oAuthTokenSecret)
    {
        // Build the parameter string
        $outParams = [];
        foreach ($parameters as $name => $value) {
            $outParams[$name] = rawurlencode($name) . '=' . rawurlencode($value);
        }
        asort($outParams);
        $parameterString = implode('&', $outParams);

        // Build the signature base string
        $payload = implode('&', [
            $requestMethod,
            rawurlencode($url),
            rawurlencode($parameterString),
        ]);

        // Set The signing Key
        $signingKey = implode('&', [rawurlencode($this->consumerSecret), rawurlencode($oAuthTokenSecret)]);

        return base64_encode(hash_hmac('sha1', $payload, $signingKey, true));
    }

    public function buildOAuthHeader($parameters)
    {
        $out = [];
        foreach ($parameters as $name => $value) {
            $out[] = sprintf('%s="%s"', rawurlencode($name), rawurlencode($value));
        }
        return implode(',', $out);
    }
}