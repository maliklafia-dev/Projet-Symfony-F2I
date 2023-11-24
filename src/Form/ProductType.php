<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Fill this field !'
                    ]),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'The product name is too short',
                        'maxMessage' => 'The product name is too long',
                    ])
                ],
            ])
            ->add('price', MoneyType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Fill this field !'
                    ]),
                    new Positive([
                        'message'  => 'The price can\'t be negative'
                    ]),
                ],
                'invalid_message' => 'Price must be a number'
            ])
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Fill this field !'
                    ])
                ]
            ])
            ->add('quantity', IntegerType::class,  [
                'constraints' =>
                [
                    new NotBlank([
                        'message' => 'Fill this field !'
                    ])
                ]
            ])
            ->add('image', FileType::class,  [
                'data_class' => null,
                'constraints' => $options['data']->getId() ? [] : [
                    new NotBlank([
                        'message' => 'Fill this field !'
                    ]),
                    new Image([
                        'mimeTypesMessage' => ['This file format is not supported'],
                        'mimeTypes' => ['image/jpeg', 'image/gif', 'image/png']
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
