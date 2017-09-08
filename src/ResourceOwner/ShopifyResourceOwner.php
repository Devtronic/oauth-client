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

use Devtronic\OAuth\AccessToken;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ShopifyResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The name of the Shopify store
     * @var string
     */
    protected $storeName = '';

    /**
     * The character for imploding the scopes. In most cases this is a space
     * @var string
     */
    protected $scopeSeparator = ',';

    /**
     * {@inheritdoc}
     */
    public function __construct($clientId, $clientSecret, $redirectUrl)
    {
        parent::__construct($clientId, $clientSecret, $redirectUrl);
        $this->buildUrls();
    }

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'read_content' => 'Access to Article, Blog, Comment, Page, and Redirect.',
        'write_content' => 'Access to Article, Blog, Comment, Page, and Redirect.',
        'read_themes' => 'Access to Asset and Theme.',
        'write_themes' => 'Access to Asset and Theme.',
        'read_products' => 'Access to Product, Product Variant, Product Image, Collect, Custom Collection, and Smart Collection.',
        'write_products' => 'Access to Product, Product Variant, Product Image, Collect, Custom Collection, and Smart Collection.',
        'read_product_listings' => 'Access to Product Listing, and Collection Listing.',
        'read_collection_listings' => 'Access to Product Listing, and Collection Listing.',
        'read_customers' => 'Access to Customer and Saved Search.',
        'write_customers' => 'Access to Customer and Saved Search.',
        'read_orders' => 'Access to Order, Transaction and Fulfillment.',
        'write_orders' => 'Access to Order, Transaction and Fulfillment.',
        'read_draft_orders' => 'Access to Draft Order.',
        'write_draft_orders' => 'Access to Draft Order.',
        'read_script_tags' => 'Access to Script Tag.',
        'write_script_tags' => 'Access to Script Tag.',
        'read_fulfillments' => 'Access to Fulfillment Service.',
        'write_fulfillments' => 'Access to Fulfillment Service.',
        'read_shipping' => 'Access to Carrier Service, Country and Province.',
        'write_shipping' => 'Access to Carrier Service, Country and Province.',
        'read_analytics' => 'Access to Analytics API.',
        'read_users' => 'Access to User SHOPIFY PLUS.',
        'write_users' => 'Access to User SHOPIFY PLUS.',
        'read_checkouts' => 'Access to Checkouts.',
        'write_checkouts' => 'Access to Checkouts.',
        'read_reports' => 'Access to Reports.',
        'write_reports' => 'Access to Reports.',
        'read_price_rules' => 'Access to Price Rules.',
        'write_price_rules' => 'Access to Price Rules.',
        'read_marketing_events' => 'Access to Marketing Event.',
        'write_marketing_events' => 'Access to Marketing Event.',
    ];

    /**
     * @param string[] $scopes The scopes
     * @param string $authCode The code from the authorize flow
     *
     * @return AccessToken The Access Token
     * @throws ClientException If the request fails
     */
    public function getAccessToken($scopes, $authCode)
    {
        $client = new Client(['verify' => false]);
        $res = null;

        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'code' => $authCode,
        ];

        /** @throws ClientException */
        $res = $client->post($this->tokenUrl, [
            'form_params' => $params
        ]);

        $token = $this->fetchResponse($res->getBody()->getContents(), $scopes);

        return $token;
    }

    /**
     * Build the URLs
     */
    protected function buildUrls()
    {
        $this->tokenUrl = 'https://' . $this->storeName . '.myshopify.com/admin/oauth/access_token';
        $this->authorizeUrl = 'https://' . $this->storeName . '.myshopify.com/admin/oauth/authorize';
    }

    /**
     * @return string
     */
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param string $storeName
     * @return ShopifyResourceOwner
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
        $this->buildUrls();
        return $this;
    }
}
