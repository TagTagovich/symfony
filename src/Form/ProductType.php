<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Property;
use App\Entity\ProductProperty;
use App\Entity\ProductPhoto;
use App\Form\ProductPropertyType;
use App\Form\ProductPhotoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('name', TextType::class, ['label' => 'Наименование'])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('price',TextType::class, ['label' => 'Цена'])
            ->add('slug', TextType::class, ['label' => 'Slug'])
            ->add('type', ChoiceType::class, [
                    'choices'  => [
                        'Комплектующее' => 'комплектующее',
                        'Готовое изделие' => 'готовое изделие',
                        'Набор' => 'набор'],
                    'label' => 'Тип'
                    
                 ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Активен'
            ])
            ->add('basePrice', TextType::class, ['label' => 'Базовая цена'])
            ->add('discPrice', TextType::class, ['label' => 'Цена со скидкой'])
            ->add('accessOddment', TextType::class, ['label' => 'Доступный остаток'])
            ->add('componentsComport', TextType::class, ['label' => 'Комплектующие(для набора)'])
            ->add('consumableWare', TextType::class, ['label' => 'Расходники(для готового изделия)'])
            ->add('createdAt', DateType::class, [
    'widget' => 'choice',
    'input'  => 'datetime_immutable'
])
            //->add('createdAt',  )
            ->add('weight', TextType::class, ['label' => 'Вес'])
            ->add('width', TextType::class, ['label' => 'Ширина'])
            ->add('height', TextType::class, ['label' => 'Высота'])
            ->add('length', TextType::class, ['label' => 'Длина'])
            /*->add('category', EntityType::class, ['class' => Category::class, 'label' => 'Категория', 'choice_label' => 'title', 'multiple' => true])*/
            //->add('productProperty', ProductProperty::class)
            /*->add('category', CollectionType::class, [
            'entry_type' => CategoryType::class,
            'entry_options' => ['label' => false], 'attr' => ['class' => 'category-box'],

            'allow_add' => true,
            'prototype' => true,
        ])*/
            /*->add('productPhotos', EntityType::class, ['class' => ProductPhoto::class, 'label' => 'Фото товара', 'choice_label' => 'image', 'multiple' => true])*/

           /* ->add('product_photos', CollectionType::class, [
            'entry_type' => ProductPhotoType::class,
            'entry_options' => ['label' => false], 'attr' => ['class' => 'product_photos'],

            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false,
        ])*/
            /*->add('product_photos', CollectionType::class, [
            'entry_type' => ProductPhotoType::class,
            'entry_options' => ['label' => false], 'attr' => ['class' => 'product-photos-box'],

            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false,
        ])*/
          /* ->add('product_properties', CollectionType::class, [
            'entry_type' => ProductPropertyType::class, 'entry_options' => ['label' => false], 'attr' => ['class' => 'product_properties'],

            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'by_reference' => false,
            'mapped' => false,
        ])*/

            ->add('submit_product', SubmitType::class, ['label' => 'Сохранить'])
            /*->add('productProperties', EntityType::class, ['class' => ProductProperty::class, 'label' => 'Свойства продукта', 'choice_label' => 'value', 'expanded' => true])*/
            /*->add('productProperties', ProductPropertyType::class, array('data_class' => null, 'label' => 'Свойства товара', 'required' => false));*/
                                       
            //->add('productPhoto', ProductPhotoType::class)
            //->add('productProperties')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
        

    
