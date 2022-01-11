<?php

namespace App\Form;

use App\Entity\ProductPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ProductPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('updatedAt')
            ->add('image', VichImageType::class, ['label' => 'Файл изображения', 'required' => false])
            ->add('submit_product_photo', SubmitType::class, ['label' => 'Сохранить'])
            ->add('button_product_photo', ButtonType::class, ['label' => 'Отменить'])

          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductPhoto::class,
        ]);
    }
}
