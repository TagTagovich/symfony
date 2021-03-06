<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PassowrdType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, [
                'required' => true,
                'label' => 'Логин'
            ])
            ->add('password', PassowrdType::class, [
                'required' => false,
                'label' => 'Пароль'
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return 'app_login';
    }
}