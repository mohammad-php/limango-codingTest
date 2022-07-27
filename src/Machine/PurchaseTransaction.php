<?php
declare(strict_types=1);

namespace App\Machine;

/**
 *
 */
class PurchaseTransaction implements PurchaseTransactionInterface
{

    /**
     * @var int
     */
    private int $itemQuantity;
    /**
     * @var float
     */
    private float $paidAmount;

    /**
     * @param int $itemQuantity
     * @return void
     */
    public function setItemQuantity(int $itemQuantity): void
    {
        $this->itemQuantity = $itemQuantity;
    }

    /**
     * @return int
     */
    public function getItemQuantity(): int
    {
        return $this->itemQuantity;
    }

    /**
     * @param float $paidAmount
     * @return void
     */
    public function setPaidAmount(float $paidAmount): void
    {
        $this->paidAmount = $paidAmount;
    }

    /**
     * @return float
     */
    public function getPaidAmount(): float
    {
        return $this->paidAmount;
    }


}