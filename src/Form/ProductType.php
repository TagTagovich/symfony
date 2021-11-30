<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductPhoto;
use App\Form\ProductPhotoType;
use App\Form\ProductPropertyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        /*$builder->add('images', CollectionType::class, [
            'entry_type' => ProductPhotoType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
        ]);*/

        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('slug')
            ->add('type', ChoiceType::class, [
                    'choices'  => [
                        'Комплектующее' => 'комплектующее',
                        'Готовое изделие' => 'готовое изделие',
                        'Набор' => 'набор'
                    ],
                 ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Активен'
            ])
            //->add('basePrice')
            //->add('discPrice')
            //->add('accessOddment')
            //->add('componentsComport')
            //->add('consumableWare')
            //->add('createdAt')
            ->add('weight')
            ->add('width')
            ->add('height')
            ->add('length')
            //->add('category')
            //, EntityType::class, ['class' => Category::class ])
                                     
            //->add('productPhoto', ProductPhotoType::class)
            //->add('productProperties', ProductPropertyType::class)
        ;
        

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
