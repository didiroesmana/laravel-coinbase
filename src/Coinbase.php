<?php

namespace Didiroesmana\LaravelCoinbase;

use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;
use Coinbase\Wallet\Value\Money;
use Coinbase\Wallet\Resource\Checkout;

class Coinbase 
{
	/**
	 * Coinbase client
	 * @var Coinbase\Wallet\Client
	 */
	protected $client;

	public function __construct($apiKey, $apiSecret)
	{
		$configuration = Configuration::apiKey($apiKey, $apiSecret);
		$client = Client::create($configuration);
		$this->client = $client;
	}

	public function createMoney($value, $currency='USD')
	{
		return new Money($value, $currency);
	}

	/**
	 * Checkout Params
	 * $params = array(
	 *	    'name'               => 'My Order',
	 *	    'amount'             => new Money(100, 'USD'),
	 *	    'metadata'           => array( 'order_id' => $custom_order_id )
  	 *	);
	 * @param  array $params [description]
	 * @return url         [description]
	 */
	public function getCheckoutUrl($params)
	{
		$checkout = new Checkout($params);
		$this->client->createCheckout($checkout);
		$code = $checkout->getEmbedCode();
		$redirectUrl = "https://www.coinbase.com/checkouts/$code";

		return $redirectUrl;
	}

	/**
	 * Get Coinbase Client
	 * @return \Coinbase\Wallet\Client Coinbase client instance
	 */
	public function getClient()
	{
		return $this->client;
	}
}