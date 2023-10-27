<?php

declare(strict_types=1);

namespace App;

use Carbon\Carbon;

class TradingPairInfo
{
    public function getInfo(TradingPair $pair): string
    {
        $openTime = Carbon::createFromTimestamp($pair->getData()['openTime'] / 1000);
        $closeTime = Carbon::createFromTimestamp($pair->getData()['closeTime'] / 1000);

        return "Symbol: {$pair->getData()['symbol']}\n" .
            "Price Change: {$pair->getData()['priceChange']}\n" .
            "Price Change Percent: {$pair->getData()['priceChangePercent']}\n" .
            "Weighted Average Price: {$pair->getData()['weightedAvgPrice']}\n" .
            "Previous Close Price: {$pair->getData()['prevClosePrice']}\n" .
            "Last Price: {$pair->getData()['lastPrice']}\n" .
            "Last Quantity: {$pair->getData()['lastQty']}\n" .
            "Bid Price: {$pair->getData()['bidPrice']}\n" .
            "Bid Quantity: {$pair->getData()['bidQty']}\n" .
            "Ask Price: {$pair->getData()['askPrice']}\n" .
            "Ask Quantity: {$pair->getData()['askQty']}\n" .
            "Open Price: {$pair->getData()['openPrice']}\n" .
            "High Price: {$pair->getData()['highPrice']}\n" .
            "Low Price: {$pair->getData()['lowPrice']}\n" .
            "Volume: {$pair->getData()['volume']}\n" .
            "Quote Volume: {$pair->getData()['quoteVolume']}\n" .
            "Open Time: {$openTime->toDateTimeString()}\n" .
            "Close Time: {$closeTime->toDateTimeString()}\n" .
            "First Trade ID: {$pair->getData()['firstId']}\n" .
            "Last Trade ID: {$pair->getData()['lastId']}\n" .
            "Trade Count: {$pair->getData()['count']}\n";
    }
}