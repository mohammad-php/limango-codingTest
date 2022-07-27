<?php
declare(strict_types=1);

namespace App\Machine;

/**
 * Interface PurchasableItemInterface
 * @package App\Machine
 */
interface PurchaseTransactionInterface
{
    /**
     * @param int $itemQuantity
     */
    public function setItemQuantity(int $itemQuantity);

    /**
     * @return integer
     */
    public function getItemQuantity(): int;

    /**
     * @param float $paidAmount
     */
    public function setPaidAmount(float $paidAmount);

    /**
     * @return float
     */
    public function getPaidAmount(): float;
}