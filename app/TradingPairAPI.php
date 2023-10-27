<?php

declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class TradingPairAPI
{
    private Client $client;
    private const API_URL = "https://api4.binance.com/api/v3/ticker/24hr";

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchData(TradingPair $pairSymbol): void
    {
        $url = self::API_URL . "?symbol={$pairSymbol->getSymbolPair()}";

        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);

        $pairSymbol->setData($data);
    }

    public function fetchTradingPairsData(array $symbols): TradingPairCollection
    {
        $collection = new TradingPairCollection();

        foreach ($symbols as $symbol) {
            $pair = new TradingPair($symbol);
            $this->fetchData($pair);
            $collection->add($pair);
        }
        return $collection;
    }
}