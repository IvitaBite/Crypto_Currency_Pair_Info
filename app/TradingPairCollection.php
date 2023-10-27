<?php

declare(strict_types=1);

namespace App;

class TradingPairCollection
{
    private array $tradingPairs;

    public function __construct(array $tradingPairs = [])
    {
        foreach ($tradingPairs as $tradingPair)
            $this->add(new TradingPair($tradingPair));
    }

    public function add(TradingPair $tradingPair): void
    {
        $this->tradingPairs[] = $tradingPair;
    }

    public function getTradingPairs(): array
    {
        return $this->tradingPairs;
    }
}