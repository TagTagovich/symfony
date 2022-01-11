<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Название'])
            ->add('property_key', TextType::class, ['label' => 'Код'])
            ->add('type', ChoiceType::class, [
                    'label' => 'Тип',
                    'choices'  => [
                    'Строка' => 'Строка',
                    'Число' => 'Число'
                    ],
                 ])
            ->add('submit', SubmitType::class, ['label' => 'Сохранить'])
            ->add('btn_cancel', ButtonType::class, ['label' => 'Отмена'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
