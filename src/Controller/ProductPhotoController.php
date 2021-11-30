<?php

namespace App\Controller;

use App\Entity\ProductPhoto;
use App\Form\ProductPhoto1Type;
use App\Repository\ProductPhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * @Route("/product/photo")
 */
class ProductPhotoController extends AbstractController
{
    /**
     * @Route("/", name="product_photo_index", methods={"GET"})
     */
    public function index(ProductPhotoRepository $productPhotoRepository): Response
    {
        return $this->render('product_photo/index.html.twig', [
            'product_photos' => $productPhotoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_photo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productPhoto = new ProductPhoto();
        $form = $this->createForm(ProductPhoto1Type::class, $productPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productPhoto);
            $entityManager->flush();

            return $this->redirectToRoute('product_photo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_photo/new.html.twig', [
            'product_photo' => $productPhoto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_photo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProductPhoto $productPhoto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductPhoto1Type::class, $productPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('product_photo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_photo/edit.html.twig', [
            'product_photo' => $productPhoto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="product_photo_delete", methods={"POST"})
     */
    public function delete(Request $request, ProductPhoto $productPhoto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productPhoto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($productPhoto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_photo_index', [], Response::HTTP_SEE_OTHER);
    }
}
