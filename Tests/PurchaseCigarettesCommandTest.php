<?php
declare(strict_types=1);

namespace Tests;

use App\Machine\CigaretteMachine;
use App\Machine\PurchaseTransaction;
use PHPUnit\Framework\TestCase;


class PurchaseCigarettesCommandTest extends TestCase
{
    /**
     * @return void
     */
    public function testCanExecuteCommand()
    {
        $purchaseTransaction = new PurchaseTransaction();
        $purchaseTransaction->setItemQuantity(2);
        $purchaseTransaction->setPaidAmount(11.02);

        $cigaretteMachine = new CigaretteMachine();
        $purchasedItem = $cigaretteMachine->execute($purchaseTransaction);

        $change = $purchasedItem->getChange();
        $changeWithCount = array_map(
            static fn ($coin, $count) => [$coin, $count],
            array_keys($change),
            $change
        );

        $changesActual = [
            [
                1,
                1
            ],
            [
                "0.02",
                2
            ]
        ];
        
        $this->assertEquals($changeWithCount, $changesActual);

    }

}