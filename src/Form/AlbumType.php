<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Image;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => function(Artist $artist) {
                    return $artist->getName();
                }]
            )
            ->add('albumhoes', FileType::class, [
                'label' => 'Afbeelding',

                'mapped' => false,

                'required' => false,

                'constraints' => [
                    new Image([
                        'mimeTypesMessage' => 'Please upload a valid image',
                        'maxWidth' => '1920',
                        'maxHeight' => '1080',
                    ])
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}