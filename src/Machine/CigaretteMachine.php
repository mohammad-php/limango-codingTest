<?php
declare(strict_types=1);

namespace App\Machine;

use App\Coin\EuroCoin;
use App\Specification\InvalidQuantitySpecification;
use App\Specification\NotEnoughAmountSpecification;
use Symfony\Component\Console\Exception;

/**
 * Class CigaretteMachine
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
    /**
     *
     */
    public const ITEM_PRICE = 4.99;

    /**
     * @return float
     */
    public function getItemPrice(): float
    {
        return static::ITEM_PRICE;
    }

    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction): PurchasedItemInterface
    {
        $notEnoughAmountSpec = new NotEnoughAmountSpecification($this->getItemPrice());
        if (!$notEnoughAmountSpec->isSatisfiedBy($purchaseTransaction)) {
            throw new Exception\LogicException(
                'Not Enough Amount!'
            );
        }

        $invalidQuantitySpec = new InvalidQuantitySpecification();
        if (!$invalidQuantitySpec->isSatisfiedBy($purchaseTransaction)) {
            throw new Exception\LogicException(
                'Invalid packs quantity, you must choose at least 1 pack of cigarettes'
            );
        }

        return new PurchasedItem(new EuroCoin(), $purchaseTransaction, $this->getItemPrice());
    }

}