<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\Sex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sex')
            ->add('age')
            ->add('sex2', EntityType::class, [
                'class' => Sex::class, 
                'choice_label' => 'name', 
                'multiple' => false, 
                'expanded' => false
                ])
            ->add('father', EntityType::class, [
                'class' => Person::class, 
                'choice_label' => 'father_id', 
                'multiple' => false, 
                'expanded' => false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
