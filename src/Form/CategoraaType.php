<?php

namespace App\Form;

use App\Entity\Categoraa;
use App\Repository\CategoraaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class CategoraaType extends AbstractType
{
    private $categoraaRepository;

    public function __construct(CategoraaRepository $categoraaRepository)
    {
        $this->categoraaRepository = $categoraaRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Наименование', 'required' => false])
            /*->add('parent', EntityType::class, ['class' => Categoraa::class, 'label' => 'Родительская категория',

           ]) */
            ->add('parent', EntityType::class, ['class' => Categoraa::class, 'label' => 'Родительская категория', 'required' => false /*,'attr' => ['name' => 'perec']*/ /*'choices' => $this->categoraaRepository->findOneBy([
    'parent' => 'Food',
    'title' => 'ASC'
])*/
                
           ])
            /*->add('description', TextType::class, ['label' => 'Описание'])
            ->add('slug', TextType::class, ['label' => 'Слаг'])*/
            ->add('filter_b', SubmitType::class, ['label' => 'Сортировать по родительской категории'])
            ->add('filter_all', SubmitType::class, ['label' => 'Показать все категории'])
            ->add('submit', SubmitType::class, ['label' => 'Сохранить'])
            ->add('btn_cancel', ButtonType::class, ['label' => 'Отмена'])              
      ;  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categoraa::class,
        ]);
    }
}
