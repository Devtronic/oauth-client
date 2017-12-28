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

class InstagramResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://api.instagram.com/oauth/authorize/';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://api.instagram.com/oauth/access_token';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'basic' => 'To read a user\'s profile info and media',
        'public_content' => 'To read any public profile info and media on a user\'s behalf',
        'follower_list' => 'To read the list of followers and followed-by users',
        'comments' => 'To post and delete comments on a user\'s behalf',
        'relationships' => 'To follow and unfollow accounts on a user\'s behalf',
        'likes' => 'To like and unlike media on a user\'s behalf',
    ];

    public function handleGetAccessTokenParameters($parameters)
    {
        $parameters['client_id'] = $this->clientId;
        $parameters['client_secret'] = $this->clientSecret;

        return $parameters;
    }
}
