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
use GuzzleHttp\Exception\ClientException;

class DeezerResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://connect.deezer.com/oauth/auth.php';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://connect.deezer.com/oauth/access_token.php';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'basic_access' => 'Access users basic information',
        'email' => 'Get the user\'s email',
        'offline_access' => 'Access user data any time',
        'manage_library' => 'Manage users\' library',
        'manage_community' => 'Manage users\' friends',
        'delete_library' => 'Delete library items',
        'listening_history' => 'Allow the application to access the user\'s listening history',
    ];

    /** {@inheritdoc} */
    protected $scopeSeparator = ',';

    /** {@inheritdoc} */
    protected $scopeParameterName = 'perms';

    public function fetchResponse($tokenData, $scopes)
    {
        $parsedTokenData = [];
        parse_str($tokenData, $parsedTokenData);
        return parent::fetchResponse(json_encode($parsedTokenData), $scopes);
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
            'app_id' => $this->clientId,
            'secret' => $this->clientSecret,
            'code' => $authCode,
            'output' => 'json',
        ];

        /** @throws ClientException */
        $res = $client->post($this->tokenUrl, [
            'form_params' => $params
        ]);

        $token = $this->fetchResponse($res->getBody()->getContents(), $scopes);

        return $token;
    }
}
