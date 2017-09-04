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

class GitHubResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://github.com/login/oauth/authorize';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://github.com/login/oauth/access_token';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'user' => 'Grants read/write access to profile info only. Note that this scope includes user:email and user:follow.',
        'user:email' => 'Grants read access to a user\'s email addresses.',
        'user:follow' => 'Grants access to follow or unfollow other users.',
        'public_repo' => 'Grants read/write access to code, commit statuses, collaborators, and deployment statuses for public repositories and organizations. Also required for starring public repositories.',
        'repo' => 'Grants read/write access to code, commit statuses, invitations, collaborators, adding team memberships, and deployment statuses for public and private repositories and organizations.',
        'repo_deployment' => 'Grants access to deployment statuses for public and private repositories. This scope is only necessary to grant other users or services access to deployment statuses, without granting access to the code.',
        'repo:status' => 'Grants read/write access to public and private repository commit statuses. This scope is only necessary to grant other users or services access to private repository commit statuses without granting access to the code.',
        'repo:invite' => 'Grants accept/decline abilities for invitations to collaborate on a repository. This scope is only necessary to grant other users or services access to invites without granting access to the code.',
        'delete_repo' => 'Grants access to delete adminable repositories.',
        'notifications' => 'Grants read access to a user\'s notifications. repo also provides this access.',
        'gist' => 'Grants write access to gists.',
        'read:repo_hook' => 'Grants read and ping access to hooks in public or private repositories.',
        'write:repo_hook' => 'Grants read, write, and ping access to hooks in public or private repositories.',
        'admin:repo_hook' => 'Grants read, write, ping, and delete access to hooks in public or private repositories.',
        'admin:org_hook' => 'Grants read, write, ping, and delete access to organization hooks. Note: OAuth tokens will only be able to perform these actions on organization hooks which were created by the OAuth App. Personal access tokens will only be able to perform these actions on organization hooks created by a user.',
        'read:org' => 'Read-only access to organization, teams, and membership.',
        'write:org' => 'Publicize and unpublicize organization membership.',
        'admin:org' => 'Fully manage organization, teams, and memberships.',
        'read:public_key' => 'List and view details for public keys.',
        'write:public_key' => 'Create, list, and view details for public keys.',
        'admin:public_key' => 'Fully manage public keys.',
        'read:gpg_key' => 'List and view details for GPG keys.',
        'write:gpg_key' => 'Create, list, and view details for GPG keys.',
        'admin:gpg_key' => 'Fully manage GPG keys.',
    ];

    public function fetchResponse($tokenData, $scopes)
    {
        $parsedTokenData = [];
        parse_str($tokenData, $parsedTokenData);
        return parent::fetchResponse(json_encode($parsedTokenData), $scopes);
    }
}
