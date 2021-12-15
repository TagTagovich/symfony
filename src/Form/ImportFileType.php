<?php

namespace App\Form;

use App\Entity\ImportFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
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
                'label' => 'File (.xls/.xlsx file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '100M',
                        'mimeTypes' => [
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid .xls/.xlsx document',
                    ])
                ],
            ])
            ;

    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImportFile::class,
        ]);
    }
}


    

 
