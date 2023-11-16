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
        $builder
            ->add('iban')
            ->add('balance')
            ->add('maxDebitAmount')
            ->add('type', EnumType::class, ['class' => \App\Enum\AccountType::class])
            ->add('person', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'lastname'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Account::class,
        ]);
    }
}
