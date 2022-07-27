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
        $coinCombination = [
            1.0, 2.0,
            0.01, 0.02, 0.05,
            0.1, 0.2, 0.5,
        ];

        usort(
            $coinCombination,
            static function (float $a, float $b) {
                $result = bccomp((string)$a, (string)$b, 2);

                return $result >= 0 ? -1 : 1;
            }
        );

        return $coinCombination;
    }
}
