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

class TwitterResourceOwner extends OAuth1ResourceOwner
{
    /** {@inheritdoc} */
    protected $authorizeUrl = 'https://api.twitter.com/oauth/authenticate';

    /** {@inheritdoc} */
    protected $requestTokenUrl = 'https://api.twitter.com/oauth/request_token';

    /** {@inheritdoc} */
    protected $accessTokenUrl = 'https://api.twitter.com/oauth/access_token';
}