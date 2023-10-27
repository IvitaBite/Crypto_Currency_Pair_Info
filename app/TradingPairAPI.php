<?php

declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TradingPairAPI
{
    private string $apiUrl;
    private Client $http;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
        $this->http = new Client();
    }

    public function getTradingPairsData(array $symbols): ?TradingPairCollection
    {
        $collection = new TradingPairCollection();

        foreach ($symbols as $symbol) {
            $url = $this->apiUrl . "?symbol={$symbol}BTC";

            try {
                $response = $this->http->get($url);

                if ($response->getStatusCode() !== 200) {
                    throw new \RuntimeException("Received an unexpected HTTP status code for symbol $symbol: " . $response->getStatusCode());
                }

                $data = json_decode($response->getBody()->getContents(), true);

                if ($data === null) {
                    throw new \RuntimeException("Error decoding JSON response for symbol $symbol");
                }

                foreach ($data as $pairData) {
                    $pair = new TradingPair(
                        $pairData['symbol'],
                        $pairData['priceChange'],
                        $pairData['priceChangePercent'],
                        $pairData['weightedAvgPrice'],
                        $pairData['prevClosePrice'],
                        $pairData['lastPrice'],
                        $pairData['lastQty'],
                        $pairData['bidPrice'],
                        $pairData['bidQty'],
                        $pairData['askPrice'],
                        $pairData['askQty'],
                        $pairData['openPrice'],
                        $pairData['highPrice'],
                        $pairData['lowPrice'],
                        $pairData['volume'],
                        $pairData['quoteVolume'],
                        (int)$pairData['openTime'],
                        (int)$pairData['closeTime'],
                        (int)$pairData['firstId'],
                        (int)$pairData['lastId'],
                        (int)$pairData['count']
                    );
                    $collection->add($pair);
                }
            } catch (GuzzleException $e) {
                echo "GuzzleException: " . $e->getMessage() . "\n";
                return null;
            } catch (\RuntimeException $e) {
                echo "RuntimeException: " . $e->getMessage() . "\n";
                return null;
            }
        }

        return $collection;
    }
}
