<?php
declare(strict_types=1);

namespace App\Specification;

use App\Machine\PurchaseTransactionInterface;


class NotEnoughAmountSpecification implements SpecificationInterface
{

    /**
     * @var float
     */
    private float $itemPrice;

    /**
     * @param float $itemPrice
     */
    public function __construct(float $itemPrice)
    {
        $this->itemPrice = $itemPrice;
    }

    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     * @return bool
     */
    public function isSatisfiedBy(PurchaseTransactionInterface $purchaseTransaction): bool
    {
        $itemQuantity = $purchaseTransaction->getItemQuantity();
        $itemRequiredAmount = (float) bcmul((string) $this->itemPrice, (string) $itemQuantity, 2);

        return (bccomp((string) $purchaseTransaction->getPaidAmount(), (string) $itemRequiredAmount, 2) !== -1);
    }
}
