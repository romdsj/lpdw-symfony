<?php

namespace App\Entity;

use App\Enum\AccountType;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Iban(
        message: 'Ce n\'est pas un IBAN valide',
    )]
    #[ORM\Column(length: 255)]
    private ?string $iban = null;

    #[ORM\Column]
    private ?int $balance = null;

    #[ORM\OneToMany(mappedBy: 'debitAccount', targetEntity: Transaction::class, orphanRemoval: true)]
    private Collection $debitTransactions;

    #[ORM\OneToMany(mappedBy: 'creditAccount', targetEntity: Transaction::class, orphanRemoval: true)]
    private Collection $creditTransactions;

    #[ORM\Column]
    private ?int $maxDebitAmount = null;

    #[ORM\Column]
    private AccountType $type;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $person = null;

    public function __construct()
    {
        $this->debitTransactions = new ArrayCollection();
        $this->creditTransactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): static
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBalance(): ?int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): static
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getDebitTransactions(): Collection
    {
        return $this->debitTransactions;
    }

    public function addDebitTransaction(Transaction $debitTransaction): static
    {
        if (!$this->debitTransactions->contains($debitTransaction)) {
            $this->debitTransactions->add($debitTransaction);
            $debitTransaction->setDebitAccount($this);
        }

        return $this;
    }

    public function removeDebitTransaction(Transaction $debitTransaction): static
    {
        if ($this->debitTransactions->removeElement($debitTransaction)) {
            // set the owning side to null (unless already changed)
            if ($debitTransaction->getDebitAccount() === $this) {
                $debitTransaction->setDebitAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transaction>
     */
    public function getCreditTransactions(): Collection
    {
        return $this->creditTransactions;
    }

    public function addCreditTransaction(Transaction $creditTransaction): static
    {
        if (!$this->creditTransactions->contains($creditTransaction)) {
            $this->creditTransactions->add($creditTransaction);
            $creditTransaction->setCreditAccount($this);
        }

        return $this;
    }

    public function removeCreditTransaction(Transaction $creditTransaction): static
    {
        if ($this->creditTransactions->removeElement($creditTransaction)) {
            // set the owning side to null (unless already changed)
            if ($creditTransaction->getCreditAccount() === $this) {
                $creditTransaction->setCreditAccount(null);
            }
        }

        return $this;
    }

    public function getMaxDebitAmount(): ?int
    {
        return $this->maxDebitAmount;
    }

    public function setMaxDebitAmount(int $maxDebitAmount): static
    {
        $this->maxDebitAmount = $maxDebitAmount;

        return $this;
    }

    public function getType(): ?AccountType
    {
        return $this->type;
    }

    public function setType(AccountType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

        return $this;
    }
}
