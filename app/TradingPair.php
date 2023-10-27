<?php

declare(strict_types=1);

namespace App;

class TradingPair
{
    private string $symbol;
    private const BTC = 'BTC';
    private array $data = [];

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function getSymbolPair(): string
    {
        return $this->symbol . self::BTC;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}