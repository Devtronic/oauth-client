# OAuth Client
This is a simple client for OAuth Services (W.I.P.)

Currently supported services:
- Google
- GitHub
- Dropbox
- PayPal
- Twitter
- Battle.net

More OAuth2 services coming soon

## Installation
```bash
$ composer require devtronic/oauth-client
```

## Usage

OAuth 2.0
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

OAuth 1.0
```php
<?php

$ro = new \Devtronic\OAuth\ResourceOwner\TwitterResourceOwner(
    $customerKey = '<your-customer-key>',
    $customerSecret = '<your-customer-secret>',
    $redirectUrl = '<your-redirect-url>' # This script for example
);

if (!isset($_REQUEST['oauth_token'])) {
    header('location: ' . $ro->getAuthorizeUrl());
    exit;
} else {
    // Get the Token
    $token = $ro->getAccessToken($_REQUEST['oauth_token'], $_REQUEST['oauth_verifier']);
    
    // Start your own request
    $client = new \GuzzleHttp\Client(['verify' => false]);
    $url = 'https://api.twitter.com/1.1/account/verify_credentials.json';
    $res = $client->request('GET', $url, [
        'headers' => [
            // Sign the request and get the auth header
            'Authorization' => $ro->getAuthorizationHeader(
                'GET',   # Request Method 
                $url,    # Requested URL
                [],      # Request Parameters (GET, POST etc.)
                $token   # The previously received AccessToken
            ),
        ]
    ]);
    echo '<pre>';
    print_r(json_decode($res->getBody()->getContents(), true));
}
```
