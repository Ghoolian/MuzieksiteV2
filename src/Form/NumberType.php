<?php

namespace App\Form;

use App\Entity\Number;
use App\Entity\Album;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NumberType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Duration')
            ->add('album', EntityType::class, [
                'class' => Album::class,
                'choice_label' => function(Album $albums) {
                    return $albums->getName();
                }
            ]);
        // Voor succesvol toevoegen van nieuw number
        //, EntityType::class, [
        //'class' => Albums::class
        //]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Number::class,
        ]);
    }
}
