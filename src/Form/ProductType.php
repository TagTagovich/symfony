<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductPhoto;
use App\Form\ProductPhotoType;
use App\Form\ProductProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder->add('images', CollectionType::class, [
            'entry_type' => ProductPhotoType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
        ]);

        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('slug')
            ->add('type', ChoiceType::class, [
                    'choices'  => [
                        'consumable' => 'consumable',
                        'finished product' => 'finished product',
                        'collection' => 'collection'
                    ],
                 ])
            ->add('isActive')
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
            //->add('productPhoto', ProductPhotoType::class)
            //->add('property', ProductPropertyType::class)
        ;
        

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
