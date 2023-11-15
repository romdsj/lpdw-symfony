<?php

namespace App\Validator;

use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class MaxDebitConstraintValidator extends ConstraintValidator {
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function validate($transaction, Constraint $constraint): void
    {
        if (!$transaction instanceof Transaction) {
            throw new UnexpectedTypeException($transaction, Transaction::class);
        }

        if (!$constraint instanceof MaxDebitConstraint) {
            throw new UnexpectedTypeException($constraint, MaxDebitConstraint::class);
        }

        $newDebitBalance = 0;
        if (!is_null($transaction->getId())) {
            $previousTransaction = $this->em
                ->getUnitOfWork()
                ->getOriginalEntityData($transaction);
            
            if ($transaction->getDebitAccount()->getId() === $previousTransaction['debitAccount']->getId()) {
                $amountDiff = $transaction->getAmount() - $previousTransaction['amount'];
                $newDebitBalance = $transaction->getDebitAccount()->getBalance() - $amountDiff;
            } else {
                $newDebitBalance = $transaction->getDebitAccount()->getBalance() - $transaction->getAmount();
            }
        } else {
            $newDebitBalance = $transaction->getDebitAccount()->getBalance() - $transaction->getAmount();
        }

        $invalid = $transaction->getDebitAccount()->getMaxDebitAmount() > $newDebitBalance;

        if ($invalid) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}