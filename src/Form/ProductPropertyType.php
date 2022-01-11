<?php

namespace App\Form;

use App\Entity\ProductProperty;
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('property', EntityType::class, ['class' => Property::class, 'label' => 'Свойство', 'choice_label' => 'name'])            
            ->add('value', TextType::class, ['label' => 'Значение', 'required' => false, 'empty_data' => 'John Doe'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductProperty::class,
        ]);
    }
}
