<?php
declare(strict_types=1);

namespace App\Coin;

class EuroCoin implements CoinInterface
{
    /**
     * @return float[]
     */
    public function getCoinCombination(): array
    {
        return [
            2.0,1.0,
            0.05,0.02,0.01,
            0.5,0.2,0.1
        ];

    }
}
