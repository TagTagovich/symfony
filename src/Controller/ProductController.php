<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Property;
use App\Entity\ProductProperty;
use App\Entity\ProductPhoto;
use App\Entity\Category;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;
//use Vich\UploaderBundle\Handler\DownloadHandler;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     */
    public function new(Request $request, ProductPhoto $productPh = null): Response
    {
        //$filesystem = new Filesystem();
        //$newtag = $filesystem->appendToFile('logs.png', '');
        
        $product = new Product();
        $product_prop = new ProductProperty();
        $category = new Category();
        $repo = $this->getDoctrine()->getRepository(Product::class);
        /*$repoP = $repo = $this->getDoctrine()->getRepository(ProductProperty::class);*/
        /*if($productPh){
	        $form->remove('productPhoto');
        	$product->setProductPhoto($productPh);
        }*/
        
        /*$image = new ProductPhoto();
        $image->setImage();
        $product->getImages()->add($image);*/
        /*$cat1 = new Category();
        $cat1->setName('cat1');
        $product->getCategory()->add($cat1);
        $cat2 = new Category();
        $cat2->setName('cat2');
        $product->getCategory()->add($cat2);
        // end dummy code*/

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        $datas = $form->getData();
        dump($datas);
        dump($product_prop);
        if ($form->isSubmitted() && $form->isValid()) {
           // ---------- change
            $datas = $form->getData();
            dump($datas);
            //----------
            /*$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();*/
            //$product->setCreatedAt('now');
            $entityManager = $this->getDoctrine()->getManager();
            
            $property = $product->getProductProperties();
            dump($property);
            $entityManager->persist($property);
            //$entityManager->persist($category);
            /*$entityManager->persist($cat1);
            $entityManager->persist($cat2);*/
            //$entityManager->persist($category);  
            //$iduha = $product->getId();
            //dump($iduha);
            /*$t = $product->getProductProperties()->add($product_prop);
            $y = $product->getProductProperties();
            $datas = $form->getData();
            
            dump($product_prop);
            dump($t);
            dump($datas);*/
            //$entityManager->persist($product_prop);
            //$product->addProductProperties();
            //$product->addProductProperties($product_prop);
            $entityManager->persist($product);
            
            //$product->getProductProperties();
            //
            


            //$property = $product->getProductProperties();
            //$entityManager->persist($property);
            //-----------------------------
            //$entityManager->persist($product_p);
           

            //$iduha = $entityManager->getId();
            //$repoP->setProduct($iduha);
           // dump($iduha);
            //$entityManager->persist($product_p);
            $entityManager->flush();
            

            
            
        }

        return $this->renderForm('product/new.html.twig', [
            //'product_properties' => $product_prop,
            'product' => $product,
            'form' => $form,
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

            return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index', [], Response::HTTP_SEE_OTHER);
    }
}
