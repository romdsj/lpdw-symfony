<?php
namespace App\Service;

use App\Entity\Transaction;
use App\Entity\Account;

class BalanceService {
    public function applyTransaction(Transaction $transaction, int $previousAmount = 0, Account $previousDebitAccount = null, Account $previousCreditAccount = null) {
        $amountDiff = $transaction->getAmount() - $previousAmount;
        if (is_null($previousDebitAccount) || $transaction->getDebitAccount() === $previousDebitAccount) {
            $newDebitBalance = $transaction->getDebitAccount()->getBalance() - $amountDiff;
            $transaction->getDebitAccount()->setBalance($newDebitBalance);
        } else {
            $previousDebitAccount->setBalance($previousDebitAccount->getBalance() + $previousAmount);
            $transaction->getDebitAccount()->setBalance($transaction->getDebitAccount()->getBalance() - $transaction->getAmount());
        }

        if (is_null($previousCreditAccount) || $transaction->getCreditAccount() === $previousCreditAccount) {
            $newCreditBalance = $transaction->getCreditAccount()->getBalance() + $amountDiff;
            $transaction->getCreditAccount()->setBalance($newCreditBalance);
        } else {
            $previousCreditAccount->setBalance($previousCreditAccount->getBalance() - $previousAmount);
            $transaction->getCreditAccount()->setBalance($transaction->getCreditAccount()->getBalance() + $transaction->getAmount());
        }  
    }

    public function deleteTransaction(Transaction $transaction) {
        $transaction->getDebitAccount()->setBalance($transaction->getDebitAccount()->getBalance() + $transaction->getAmount());
        $transaction->getCreditAccount()->setBalance($transaction->getCreditAccount()->getBalance() - $transaction->getAmount());
    }
}