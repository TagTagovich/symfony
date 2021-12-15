<?php

namespace App\Controller;

use App\Entity\ImportFile;
use App\Form\ImportFileType;
use App\Repository\ImportFileRepository;
use App\Service\ImportFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;


/**
 * @Route("/import/file")
 */
class ImportFileController extends AbstractController
{

    /**
     * @Route("/new", name="import_file_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, ImportFileService $importFileService): Response
    {

        $importFile = new ImportFile();
        $form = $this->createForm(ImportFileType::class, $importFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $excelFile */
            $excelFile = $form->get('file')->getData();
            if ($excelFile) {
            $excelFileName = $importFileService->upload($excelFile);
            $importFile->setExcelFilename($excelFileName);
            }
             $task = $form->getData();
            dump($task);
            $entityManager->persist($importFile);
            $entityManager->flush();
            $importFileService->newExcelFile();
            //$importFileService->updateExcelFile();

               //return $this->redirectToRoute('import_file_index', [], Response::HTTP_SEE_OTHER);
        }
            //$entityManager->remove($importFile);
           // $entityManager->flush();

        return $this->renderForm('import_file/new.html.twig', [
            'import_file' => $importFile,
            'form' => $form,
        ]);
    }
}




