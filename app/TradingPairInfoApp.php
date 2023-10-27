<?php

declare(strict_types=1);

namespace App;

class TradingPairInfoApp
{
    private const PAIR = 'ETH';
    private const PAIR_OTHER = 'LTC';
    public function run(): void
    {
        $apiUrl = "https://api4.binance.com/api/v3/ticker/24hr";

        $validPairs = [self::PAIR, self::PAIR_OTHER];

        while (true) {
            $input = readline("Enter the trading pair symbol (ETH or LTC): ");
            $pairSymbols = explode(' ', strtoupper($input));

            $invalidPairs = array_diff($pairSymbols, $validPairs);

            if (!empty($invalidPairs)) {
                echo "Invalid input! Please enter only 'ETH' or 'LTC'. Invalid pairs: " . implode(', ', $invalidPairs) . "\n";
            } else {
                break;
            }
        }
        $api = new TradingPairAPI($apiUrl);
        $collection = $api->getTradingPairsData($pairSymbols);

        $info = new TradingPairInfoApp();

        foreach ($collection->getTradingPairs() as $pair) {
            echo $info->getInfo($pair);
        }
    }

    public function getInfo(TradingPair $pair): string
    {
        return "-------------------------------------------------\n" .
            "{$pair->getSymbol()} - 24-Hour Ticker Price Change Statistics\n" .
            "Price Change: {$pair->getPriceChange()}\n" .
            "Price Change Percent: {$pair->getPriceChangePercent()}\n" .
            "Weighted Average Price: {$pair->getWeightedAvgPrice()}\n" .
            "Previous Close Price: {$pair->getPrevClosePrice()}\n" .
            "Last Price: {$pair->getLastPrice()}\n" .
            "Last Quantity: {$pair->getLastQty()}\n" .
            "Bid Price: {$pair->getBidPrice()}\n" .
            "Bid Quantity: {$pair->getBidQty()}\n" .
            "Ask Price: {$pair->getAskPrice()}\n" .
            "Ask Quantity: {$pair->getAskQty()}\n" .
            "Open Price: {$pair->getOpenPrice()}\n" .
            "High Price: {$pair->getHighPrice()}\n" .
            "Low Price: {$pair->getLowPrice()}\n" .
            "Volume: {$pair->getVolume()}\n" .
            "Quote Volume: {$pair->getQuoteVolume()}\n" .
            "Open Time: {$pair->getOpenTime()}\n" .
            "Close Time: {$pair->getCloseTime()}\n" .
            "First Trade ID: {$pair->getFirstId()}\n" .
            "Last Trade ID: {$pair->getLastId()}\n" .
            "Trade Count: {$pair->getCount()}\n";
    }
}