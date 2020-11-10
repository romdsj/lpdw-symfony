<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Person;
use App\Entity\PersonLocation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visitedAt')
            ->add('person', EntityType::class, [
                'class' => Person::class,
                'choice_label' => 'lastname'
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonLocation::class,
        ]);
    }
}
