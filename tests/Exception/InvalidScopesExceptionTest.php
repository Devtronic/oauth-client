<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\Tests\OAuth\Exception;

use Devtronic\OAuth\Exception\InvalidScopesException;
use PHPUnit\Framework\TestCase;

class InvalidScopesExceptionTest extends TestCase
{
    public function testSingle()
    {
        $this->expectException(InvalidScopesException::class);
        $this->expectExceptionMessage('The Scope(s) "Foo" was not found');
        throw new InvalidScopesException(['Foo']);
    }

    public function testSingleAsString()
    {
        $this->expectException(InvalidScopesException::class);
        $this->expectExceptionMessage('The Scope(s) "Foo" was not found');
        throw new InvalidScopesException('Foo');
    }

    public function testMultiple()
    {
        $this->expectException(InvalidScopesException::class);
        $this->expectExceptionMessage('The Scope(s) "Foo", "Bar" was not found');
        throw new InvalidScopesException(['Foo', 'Bar']);
    }
}
