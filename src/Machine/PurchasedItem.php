<?php
declare(strict_types=1);

namespace App\Machine;

use App\Coin\CoinInterface;


class PurchasedItem implements PurchasedItemInterface
{

    /**
     * @var PurchaseTransactionInterface
     */
    private PurchaseTransactionInterface $purchaseTransaction;

    /**
     * @var float
     */
    private float $itemPrice;

    /**
     * @var CoinInterface
     */
    private CoinInterface $coin;


    /**
     * @param CoinInterface $coin
     * @param PurchaseTransactionInterface $purchaseTransaction
     * @param float $itemPrice
     */
    public function __construct(
        CoinInterface $coin,
        PurchaseTransactionInterface $purchaseTransaction,
        float $itemPrice
    ) {
        $this->coin = $coin;
        $this->purchaseTransaction = $purchaseTransaction;
        $this->itemPrice = $itemPrice;
    }

    /**
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->purchaseTransaction->getItemQuantity();
    }

    /**
     * @return float
     */
    public function getTotalAmount(): float
    {
        return (float) bcmul((string) $this->itemPrice, (string) $this->getItemQuantity(), 2);
    }

    /**
     * @return array
     */
    public function getChange(): array
    {
        $coinsCombination = $this->coin->getCoinCombination();

        $totalChange = (float) bcsub((string)$this->purchaseTransaction->getPaidAmount(), (string)$this->getTotalAmount(), 2);

        $change = [];

        if (empty($totalChange)) {
            return $change;
        }

        foreach ($coinsCombination as $coin) {
            $coin = (string)$coin;
            $requiredCoins = (int) ($totalChange / $coin);

            if ($requiredCoins > 0) {
                $change[$coin] = (int) ($totalChange / $coin);
                $totalChange = (float) bcmod((string)$totalChange, $coin, 2);
                if (empty($totalChange)) {
                    return $change;
                }
            }
        }
        return $change;
    }
}