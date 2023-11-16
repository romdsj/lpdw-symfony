<?php

namespace App\Form;

use App\Entity\Account;
use App\Entity\Person;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $account = $builder->getData();
        $builder
            ->add('iban')
            ->add('balance')
            ->add('maxDebitAmount')
            ->add('type', EnumType::class, ['class' => \App\Enum\AccountType::class])
        ;

        if(is_null($account->getPerson())) {
            $builder->add('person', EntityType::class, [
                'class' => Person::class,
                'choice_label' => function (Person $person): string {
                    return $person->getFirstName() . ' ' . $person->getLastName();
                }
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
