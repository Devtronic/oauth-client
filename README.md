# OAuth Client
This is a simple client for OAuth Services (W.I.P.)

Currently supported services:
- Google
- Dropbox
- Battle.net

More OAuth2 services and OAuth 1.0 support are coming soon

## Installation
```bash
$ composer require devtronic/oauth-client
```

## Usage
```php
<?php

$ro = new \Devtronic\OAuth\ResourceOwner\GoogleResourceOwner(
    $clientId = '<your-client-id>',
    $clientSecret = '<your-client-secret>',
    $redirectUrl = '<your-redirect-url>' # This script for example
);

# Prints all available scopes
# print_r($ro->getScopes());

$scopes = [
    'https://www.googleapis.com/auth/userinfo.profile'
];

if (!isset($_REQUEST['code'])) {
    header('location: ' . $ro->getAuthorizeUrl($scopes));
    exit;
} else {
    $token = $ro->getAccessToken($scopes, $_REQUEST['code']);

    $client = new \GuzzleHttp\Client(['verify' => false]);
    $res = $client->request('GET', 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json', [
        'headers' => [
            'Authorization' => sprintf('Bearer ' . $token->getToken()),
        ]
    ]);
    echo '<pre>';
    print_r(json_decode($res->getBody()->getContents(), true));
}
```