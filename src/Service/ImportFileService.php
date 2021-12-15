<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Entity\ImportFile;
use App\Repository\ImportFileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImportFileService
{
	
    private $em;
    private $defaultPath;
    private $targetDirectory;
    private $slugger;
    private $filesystem;


	public function __construct(EntityManagerInterface $em, string $excelDirectory, $targetDirectory, SluggerInterface $slugger, Filesystem $filesystem) 
	{
        $this->em = $em;
        $this->excelDirectory = $excelDirectory;
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->filesystem = $filesystem;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            //добавить исключение
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
    
    public function newExcelFile()
	{
		$arrayMethods = array(

            'setName',
            'setDescription',
            'setPrice',
            'setSlug',
            'setType',
            //'setIsActive',
            'setBasePrice',
            'setAccessOddment',

		     
        );   
        $pathFile = $this->excelDirectory . '/'; 
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($pathFile . 'price.xlsx');
        //$spreadsheet = $reader->load($pathFile . 'price.xlsx');
        $worksheet = $spreadsheet->getActiveSheet();
        $product = new Product;
        $c = count($arrayMethods)-1;
        $i = -1;
            foreach ($worksheet->getRowIterator() as $row) {  
                $cellIterator = $row->getCellIterator();
                //true - обходить ячейки только со значениями, false - обходить также и пустые ячейки
                $cellIterator->setIterateOnlyExistingCells(TRUE);
                
                foreach ($cellIterator as $cell) {
                    $cellExt = $cell->getValue();
                    $i++;
                    $func = $arrayMethods[$i];
                    $product->$func($cellExt);
                    if ($i == $c) {
                        $product->setIsActive(false);
                        $product->setCreatedAt(new \DateTimeImmutable('now'));
                        $this->em->persist($product);
                        $this->em->flush();
                        $product = new Product;
                        $i = -1;
                    }   
                    
                }
            }
      }
                        

    public function updateExcelFile()
    {
        $arrayMethods = array(
            'setName',
            'setDescription',
            'setPrice',
            'setSlug',
            'setType',
            //'setIsActive',
            'setBasePrice',
            'setAccessOddment',

        );  
        $pathFile = $this->excelDirectory . '/'; 
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($pathFile . 'price.xlsx');            
        $worksheet = $spreadsheet->getActiveSheet();
        $c = count($arrayMethods) - 1;
        $i = -1;
        $ii = 0;
        $id = "";
        //$u = 0;
            foreach ($worksheet->getRowIterator() as $row) {
                
                $cellIterator = $row->getCellIterator();
                //true - обходить ячейки только со значениями, false - пустые и со значениями
                $cellIterator->setIterateOnlyExistingCells(FALSE);
                
                foreach ($cellIterator as $cell) {
                    //if ($u <= $c) {
                    //  $u++;  
                    //} else {
                        if ($ii == 0) {
                            $id = $cell->getValue();
                            $ii++;
                        } else {
                            $i++;
                            $func = $arrayMethods[$i];
                            $cellExt = $cell->getValue();
                            $this->em->getRepository(Product::class)->find($id)->$func($cellExt);
                                if ($i == $c) {
                                    //$this->em->getRepository(Product::class)->find($imp)->setUpdatedAt(new \DateTimeImmutable('now'));
                                    $this->em->flush();
                                    $i = -1;
                                    $ii = 0;
                                    $imp = "";                    
                                }              
                        }
                    //}
                }                  
            }
                                  
    }           
}              
