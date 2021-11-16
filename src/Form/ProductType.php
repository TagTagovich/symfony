<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('slug')
            ->add('type')
            ->add('activity')
            ->add('base_price')
            ->add('disc_price')
            ->add('access_oddment')
            ->add('components_comport')
            ->add('consumable_ware')
            ->add('created_at')
            ->add('weight')
            ->add('width')
            ->add('height')
            ->add('length')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
