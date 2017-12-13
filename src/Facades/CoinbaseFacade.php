<?php
namespace Didiroesmana\LaravelCoinbase\Facades;

use Illuminate\Support\Facades\Facade;

class CoinbaseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'coinbase';
    }
}