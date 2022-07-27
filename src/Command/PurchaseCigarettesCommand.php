<?php
declare(strict_types=1);

namespace App\Command;

use App\Machine\CigaretteMachine;
use App\Machine\PurchaseTransaction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

        $purchaseTransaction = new PurchaseTransaction();
        $purchaseTransaction->setItemQuantity($itemCount);
        $purchaseTransaction->setPaidAmount($amount);

        $cigaretteMachine = new CigaretteMachine();
        $purchasedItem = $cigaretteMachine->execute($purchaseTransaction);


        $output->writeln(
            sprintf(
                'You bought <info>%s</info> packs of cigarettes for <info>-%s€</info>, each for <info>-%s€</info>.',
                $purchasedItem->getItemQuantity(),
                $purchasedItem->getTotalAmount(),
                $cigaretteMachine->getItemPrice()
            )
        );

        $output->writeln('Your change is:');
        $change = $purchasedItem->getChange();
        $changeWithCount = array_map(
            static fn ($coin, $count) => [$coin, $count],
            array_keys($change),
            $change
        );


        $table = new Table($output);
        $table
            ->setHeaders(array('Coins', 'Count'))
            ->setRows($changeWithCount)
        ;
        $table->render();

    }
}