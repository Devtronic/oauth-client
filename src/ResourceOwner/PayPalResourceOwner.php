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

class PayPalResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = '';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = '';

    /**
     * Defines if the sandbox is used
     *
     * @var bool
     */
    protected $isSandbox = false;

    /**
     * The 2-letter country code for the auth page
     *
     * @var string
     */
    protected $countryCode = 'en';

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
        'openid' => 'Basic Authentication',
        'profile' => 'Full name, Date of birth, Time zone, Locale, Language, Gender',
        'email' => 'Email address',
        'address' => 'Street address, City, State, Country, Zip code',
        'phone' => 'Phone',
        'https://uri.paypal.com/services/paypalattributes' => 'Age range, Account status (verified), Account type, Account creation date',
        'https://uri.paypal.com/services/expresscheckout' => 'Use Seamless Checkout',
        'https://uri.paypal.com/services/invoicing' => 'Invoicing',
    ];

    /**
     * Build the URLs
     */
    protected function buildUrls()
    {
        $host = ($this->isSandbox ? 'sandbox.paypal.com' : 'paypal.com');
        $this->tokenUrl = 'https://api.' . $host . '/v1/oauth2/token';
        $this->authorizeUrl = 'https://www.' . $host . '/' . $this->countryCode . '/signin/authorize';
    }

    /**
     * @return bool
     */
    public function isSandbox()
    {
        return $this->isSandbox;
    }

    /**
     * @param bool $isSandbox
     * @return PayPalResourceOwner
     */
    public function setIsSandbox($isSandbox)
    {
        $this->isSandbox = $isSandbox;
        $this->buildUrls();
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     * @return PayPalResourceOwner
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        $this->buildUrls();
        return $this;
    }
}
