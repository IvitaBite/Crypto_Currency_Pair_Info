<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\TradingPairAPI;
use App\TradingPairInfo;

$pairSymbol = strtoupper(trim(readline("Enter the trading pair symbol (ETH or LTC): ")));

$api = new TradingPairAPI();
$collection = $api->fetchTradingPairsData([$pairSymbol]);

$info = new TradingPairInfo();

foreach ($collection->getTradingPairs() as $pair) {
    echo $info->getInfo($pair);
}



