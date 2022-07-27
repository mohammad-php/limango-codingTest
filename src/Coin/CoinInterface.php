<?php
declare(strict_types=1);

namespace App\Coin;

/**
 *
 */
interface CoinInterface
{
    /**
     * @return float[]
     */
    public function getCoinCombination(): array;
}
