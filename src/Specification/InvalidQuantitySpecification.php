<?php
declare(strict_types=1);

namespace App\Specification;

use App\Machine\PurchaseTransactionInterface;


class InvalidQuantitySpecification implements SpecificationInterface
{
    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     * @return bool
     */
    public function isSatisfiedBy(PurchaseTransactionInterface $purchaseTransaction): bool
    {
       return ($purchaseTransaction->getItemQuantity() > 0);
    }
}
