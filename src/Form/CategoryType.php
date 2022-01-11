<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Наименование'])
            ->add('description', TextType::class, ['label' => 'Описание'])
            ->add('slug', TextType::class, ['label' => 'Slug'])
            /*->add('parent', EntityType::class, ['class' => Category::class, 'label' => 'Основная категория', 'choice_label' => 'image', 'multiple' => true])*/
            //->add('products')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
