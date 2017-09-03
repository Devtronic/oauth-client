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

class BattleNetResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://eu.battle.net/oauth/authorize';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://eu.battle.net/oauth/token';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'wow.profile' => 'Access to a users World of Warcraft characters',
        'sc2.profile' => 'Access to a users StarCraft II characters',
    ];
}
