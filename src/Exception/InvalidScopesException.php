<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\OAuth\Exception;

class InvalidScopesException extends \Exception
{
    public function __construct($scopes = [], $code = 0, \Throwable $previous = null)
    {
        if (!is_array($scopes)) {
            $scopes = [$scopes];
        }
        $message = sprintf('The Scope(s) "%s" was not found', implode('", "', $scopes));
        parent::__construct($message, $code, $previous);
    }
}
