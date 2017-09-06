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
     * Instantiates a new OAuth 1.0 Resource Owner
     *
     * @param string $consumerKey The Consumer Key
     * @param string $consumerSecret The Consumer Secret
     * @param string $redirectUrl The Redirect URL
     */
    public function __construct($consumerKey, $consumerSecret, $redirectUrl)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Returns the URL for authorization
     *
     * @return string The authorization URL
     */
    public function getAuthorizeUrl()
    {
        $authParameters = [];
        if ($this->redirectUrl != '') {
            $authParameters['oauth_callback'] = $this->redirectUrl;
        }

        $client = new Client(['verify' => false]);
        $res = $client->request('GET', $this->requestTokenUrl, [
            'headers' => [
                'Authorization' => $this->getAuthorizationHeader(
                    'GET',
                    $this->requestTokenUrl,
                    $authParameters
                ),
            ]
        ]);

        $tokenResult = [];
        parse_str($res->getBody()->getContents(), $tokenResult);

        return $this->authorizeUrl . '?' . http_build_query([
                'oauth_token' => $tokenResult['oauth_token'],
            ]);
    }

    /**
     * Requests and returns the AccessToken
     *
     * @param string $requestToken The oauth_token from the request_token Call (getAuthorizeUrl)
     * @param string $oAuthVerifier The oauth_verifier from the request_token Call (getAuthorizeUrl)
     * @return AccessToken The AccessToken
     */
    public function getAccessToken($requestToken, $oAuthVerifier)
    {
        $token = new AccessToken();
        $token->setToken($requestToken);

        $authParameters = [
            'oauth_verifier' => $oAuthVerifier,
        ];

        $client = new Client(['verify' => false]);
        $res = $client->request('POST', $this->accessTokenUrl, [
            'headers' => [
                'Authorization' => $this->getAuthorizationHeader(
                    'POST',
                    $this->accessTokenUrl,
                    $authParameters,
                    $token
                )
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

    /**
     * Returns the OAuth 1.0 header string
     *
     * @param string $requestMethod The Request Method
     * @param string $url The requested URL
     * @param array $parameters The Parameters ($name => $value)
     * @param AccessToken|null $token The AccessToken
     * @return string The Header (OAuth oauth_consumer_key="foobar", ...)
     */
    public function getAuthorizationHeader($requestMethod, $url, $parameters, $token = null)
    {
        $requestMethod = strtoupper($requestMethod);

        if (!is_array($parameters)) {
            $parameters = [$parameters];
        }
        $parameters = array_merge($parameters, [
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_signature_method' => "HMAC-SHA1",
            'oauth_timestamp' => time(),
            'oauth_nonce' => substr(md5(uniqid()), 0, 6),
            'oauth_version' => "1.0",
        ]);
        if ($token != null) {
            $parameters['oauth_token'] = $token->getToken();
        }

        $secret = '';
        if ($token != null && $token instanceof AccessToken) {
            $secret = $token->getSecret();
        }

        $parameters['oauth_signature'] = $this->getSignature(
            $requestMethod,
            $url,
            $parameters,
            $secret
        );

        return 'OAuth ' . $this->buildOAuthHeaderString($parameters);
    }

    /**
     * Calculates the signature of the request
     *
     * @param string $requestMethod The request method
     * @param string $url The URL
     * @param array $parameters The request Parameters
     * @param string $oAuthTokenSecret The OAuth Token secret (can be empty for request_token calls)
     *
     * @return string The Signature
     */
    protected function getSignature($requestMethod, $url, $parameters, $oAuthTokenSecret)
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

    /**
     * Builds the OAuth header String
     *
     * @param array $parameters All parameters
     * @return string The header string
     */
    public function buildOAuthHeaderString($parameters)
    {
        $out = [];
        foreach ($parameters as $name => $value) {
            if (substr($name, 0, 6) == 'oauth_') {
                $out[] = sprintf('%s="%s"', rawurlencode($name), rawurlencode($value));
            }
        }

        return implode(',', $out);
    }
}
