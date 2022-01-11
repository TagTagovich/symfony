<?php

namespace App\Form;

use App\Entity\ImportFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
//use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class ImportFileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            
            //->add('excel_filename', TextType::class, ['label' => 'Наименование файла', 'required' => false])
            ->add('file', FileType::class, [
                'label' => 'Файл - .xls/.xlsx',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '100M',
                        'mimeTypes' => [
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ],
                        'mimeTypesMessage' => 'Пожалуйста, загрузите валидный .xls/.xlsx документ',
                    ])
                ],
            ])
            ->add('import_b', SubmitType::class, ['label' => 'Импортировать товары'])
            ->add('update_b', SubmitType::class, ['label' => 'Обновить свойства товаров'])
            ;

    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImportFile::class,
        ]);
    }
}


    

 
