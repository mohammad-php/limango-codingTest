<?php
declare(strict_types=1);

namespace App\Machine;

/**
 * Interface CigaretteMachine
 * @package App\Machine
 */
interface MachineInterface
{
    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface;

    /**
     * @return float
     */
    public function getItemPrice(): float;
}