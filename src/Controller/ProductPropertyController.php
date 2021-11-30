<?php

namespace App\Controller;

use App\Entity\ProductProperty;
use App\Form\ProductPropertyType;
use App\Repository\ProductPropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/property")
 */
class ProductPropertyController extends AbstractController
{
    /**
     * @Route("/", name="product_property_index", methods={"GET"})
     */
    public function index(ProductPropertyRepository $productPropertyRepository): Response
    {
        return $this->render('product_property/index.html.twig', [
            'product_properties' => $productPropertyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_property_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productProperty = new ProductProperty();
        $form = $this->createForm(ProductPropertyType::class, $productProperty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productProperty);
            $entityManager->flush();

            return $this->redirectToRoute('product_property_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_property/new.html.twig', [
            'product_property' => $productProperty,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_property_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductProperty $productProperty): Response
    {
        $form = $this->createForm(ProductPropertyType::class, $productProperty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_property_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product_property/edit.html.twig', [
            'product_property' => $productProperty,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="product_property_delete", methods={"POST"})
     */
    public function delete(Request $request, ProductProperty $productProperty): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productProperty->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productProperty);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_property_index', [], Response::HTTP_SEE_OTHER);
    }
}
