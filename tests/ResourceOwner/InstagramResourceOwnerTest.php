<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\Tests\OAuth\ResourceOwner;

use Devtronic\OAuth\ResourceOwner\InstagramResourceOwner;
use Devtronic\OAuth\ResourceOwner\OAuth2ResourceOwner;
use PHPUnit\Framework\TestCase;

class InstagramResourceOwnerTest extends TestCase
{
    public function testConstruct()
    {
        $instagram = new InstagramResourceOwner('client-id', 'client-secret', 'redirect.localhost');
        $this->assertInstanceOf(OAuth2ResourceOwner::class, $instagram);

        $this->assertEquals([
            'basic',
            'public_content',
            'follower_list',
            'comments',
            'relationships',
            'likes',
        ], array_keys($instagram->getScopes()));
    }

    public function testHandleGetAccessTokenParameters()
    {
        $instagram = new InstagramResourceOwner('client-id', 'client-secret', 'redirect.localhost');

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'baz',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
        ], $instagram->handleGetAccessTokenParameters(['foo' => 'bar', 'bar' => 'baz']));
    }
}
