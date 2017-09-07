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

class SlackResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://slack.com/oauth/authorize';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://slack.com/api/oauth.access';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'admin' => 'Administer your workspace',
        'bot' => 'Add a bot user with the username @your_slack_app',
        'channels:history' => 'Access content in your public channels',
        'channels:read' => 'Access information about your public channels',
        'channels:write' => 'Modify your public channels',
        'chat:write:bot' => 'Send messages as your slack app',
        'chat:write:user' => 'Send messages as you',
        'client' => 'Receive all events from a workspace in realtime',
        'commands' => 'Add commands to a workspace',
        'dnd:read' => 'Access your workspace’s Do Not Disturb settings',
        'dnd:write' => 'Modify your Do Not Disturb settings',
        'emoji:read' => 'Access your workspace’s emoji',
        'files:read' => 'Access your workspace’s files, comments, and associated information',
        'files:write:user' => 'Upload and modify files as you',
        'groups:history' => 'Access content in your private channels',
        'groups:read' => 'Access information about your private channels',
        'groups:write' => 'Modify your private channels',
        'identify' => 'Confirm your identity',
        'identity.avatar' => 'View your Slack avatar',
        'identity.basic' => 'Confirm your identity',
        'identity.email' => 'View your email address',
        'identity.team' => 'View your Slack workspace name',
        'im:history' => 'Access content in your direct messages',
        'im:read' => 'Access information about your direct messages',
        'im:write' => 'Modify your direct messages',
        'incoming-webhook' => 'Post to specific channels in Slack',
        'links:read' => 'View some URLs in messages',
        'links:write' => 'Add link previews to messages',
        'mpim:history' => 'Access your group messages',
        'mpim:read' => 'Access information about your group messages',
        'mpim:write' => 'Make changes to your group messages',
        'pins:read' => 'Access your workspace’s pinned content and associated information',
        'pins:write' => 'Add and remove pinned messages and files',
        'post' => 'Post messages to a workspace',
        'reactions:read' => 'Access your workspace’s content with emoji reactions',
        'reactions:write' => 'Modify emoji reactions',
        'read' => 'Access all content in a workspace',
        'reminders:read' => 'Access reminders created by you or for you',
        'reminders:write' => 'Add, remove, or complete reminders for you',
        'search:read' => 'Search your workspace’s content',
        'stars:read' => 'Access your starred messages and files',
        'stars:write' => 'Add or remove stars for you',
        'team:read' => 'Access information about your workspace',
        'usergroups:read' => 'Access basic information about your User Groups',
        'usergroups:write' => 'Change your User Groups',
        'users.profile:read' => 'Access your profile and your workspace’s profile fields',
        'users.profile:write' => 'Modify your profile',
        'users:read' => 'Access your workspace’s profile information',
        'users:read.email' => 'View email addresses of people on your workspace',
        'users:write' => 'Modify your profile information',
    ];

    /** {@inheritdoc} */
    public function fetchResponse($tokenData, $scopes)
    {
        $token = parent::fetchResponse($tokenData, $scopes);

        switch (substr($token->getToken(), 0, 4)) {
            case 'xoxp':
                $token->setType('user');
                break;
            case 'xoxb':
                $token->setType('bot');
                break;
            case 'xoxa':
                $token->setType('workspace');
                break;
            default:
                break;
        }

        return $token;
    }
}
