<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\Tests\OAuth;

use Devtronic\OAuth\AccessToken;
use PHPUnit\Framework\TestCase;

class AccessTokenTest extends TestCase
{
    public function testConstruct()
    {
        $token = new AccessToken();
        $this->assertTrue($token instanceof \Devtronic\OAuth\AccessToken);
    }

    public function testGetSetToken()
    {
        $token = new AccessToken();
        $this->assertSame('', $token->getToken());
        $token->setToken('1234');
        $this->assertSame('1234', $token->getToken());
    }

    public function testGetSetType()
    {
        $token = new AccessToken();
        $this->assertSame('', $token->getType());
        $token->setType('Bearer');
        $this->assertSame('Bearer', $token->getType());
    }

    public function testGetSetExpires()
    {
        $token = new AccessToken();
        $this->assertNull($token->getExpires());
        $expires = new \DateTime();
        $token->setExpires($expires);
        $this->assertEquals($expires, $token->getExpires());
    }


    public function testGetSetScopes()
    {
        $token = new AccessToken();
        $this->assertCount(0, $token->getScopes());
        $token->setScopes(['email', 'profile']);
        $this->assertCount(2, $token->getScopes());
        $this->assertEquals(['email', 'profile'], $token->getScopes());
    }

    public function testIsValid()
    {
        $token = new AccessToken();
        $this->assertTrue($token->isValid());

        $expires = new \DateTime();
        $expires->setTimestamp(time() - 3600);
        $token->setExpires($expires);
        $this->assertFalse($token->isValid());

        $expires = new \DateTime();
        $expires->setTimestamp(time() + 3600);
        $token->setExpires($expires);
        $this->assertTrue($token->isValid());
    }
}
