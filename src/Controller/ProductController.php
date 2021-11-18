<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductPhoto;
use App\Entity\ProductProperty;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Vich\UploaderBundle\Handler\DownloadHandler;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/{id}", name="product_index", methods={"GET"})
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, ProductPhoto $productPh = null, ProductProperty $productPr = null): Response
    {
            if($productPh){
	    	$photos = $productRepository->findByProductPhoto($productPh);
	    }else{
	    	$photos = $productRepository->findAll();
	    }
            
            if($productPr){
	    	$property = $productRepository->findByProductPhoto($productPr);
	    }else{
	    	$property = $productRepository->findAll();
	    }
            
         return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'productPhoto' => $productRepository->findAll(),
            'productProperty' => $productRepository->findAll()
        ]);
    }

    /**
     * @Route("/new/by_product/{id}", name="product_new", methods={"GET","POST"})
     * @Route("/new", name="product_new", methods={"GET","POST"})
     *
     */
    public function new(Request $request, ProductPhoto $productPh = null, ProductProperty $productPr = null): Response
    {
        
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        if($productPh){
	        $form->remove('productPhoto');
        	$product->setOffer($productPhoto);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
            
            return $this->redirectToRoute('product_index', ['id' => $banner->getProductPhoto()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index', ['id' => $product->getOffer()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productId = $product->getProductPhoto()->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', ['id' => $productId]], Response::HTTP_SEE_OTHER);
    }

}
