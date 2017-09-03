<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\OAuth;

class AccessToken
{
    /**
     * The Token
     * @var string
     */
    protected $token = '';

    /**
     * The Token Type
     * @var string
     */
    protected $type = '';

    /**
     * The expire date
     * @var null|\DateTime
     */
    protected $expires = null;

    /**
     * The accessible scopes with this token
     * @var array
     */
    protected $scopes = [];

    public function isValid($checkDate = null)
    {
        if ($checkDate == null) {
            $checkDate = new \DateTime();
        }

        return ($this->expires === null || $this->expires > $checkDate);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return AccessToken
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return AccessToken
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param \DateTime|null $expires
     * @return AccessToken
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param array $scopes
     * @return AccessToken
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
        return $this;
    }
}
