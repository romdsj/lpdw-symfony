<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\PersonCovid;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonCovidType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('detectedAt')
            ->add('person', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'lastname'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonCovid::class,
        ]);
    }
}
