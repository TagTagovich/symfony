<?php

namespace App\Controller;

use App\Entity\Categoraa;
use App\Form\CategoraaType;
use App\Repository\CategoraaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/categoraa")
 */
class CategoraaController extends AbstractController
{
    /**
     * @Route("/", name="categoraa_index", methods={"GET", "POST"})
     */
    public function index(CategoraaRepository $categoraaRepository, Request $request, ManagerRegistry $doctrine): Response
    
    {   
        //dump($id);
        // $request = Request::createFromGlobals();
        $categoraa = new Categoraa();
        //dump($request->query->get(['categoraa' => 'title']));
        
       // $data = $request->query->all()['categoraa']['parent'];
        //dump($data);       
        dump($request);


        $form = $this->createForm(CategoraaType::class, $categoraa);
        $form->handleRequest($request);
        $fire = 123;
        
        $repo = $this->getDoctrine()->getRepository(Categoraa::class);
        
        $categoraa = new Categoraa(); 
        
        $repository = $doctrine->getRepository(Categoraa::class);
        /*$catik = $repository->findOneBy([
            'parent' => $op
            
        ]);*/
        
        //dump($catik);
dump($request);

        /*$form->get('parent')->submit('Fabien');*/
        // находимся в контексте поля можем отправить данные через сабмит
        //сабмит за счет параметра фолс может игнорировать некоторые поля
    //$data = $request->query->all()['categoraa']['parent'];
           // dump($data);
    if ($form->isSubmitted() && $form->isValid()) {    
        if ($form->get('filter_b')->isClicked()) {
            dump($request);
            /*$datas = $form->getData();
            dump($datas);
            $datas['parent']['title'];*/
            $data = $request->request->all()['categoraa']['parent'];
            
            dump($data);
            return $this->renderForm('categoraa/index.html.twig', [
            'categor' => $categoraaRepository->findBy(['parent' => $data]),
            //'categor' => $repo->findOneBy(['title' => 'Vegetables']),
            'categoraa' => $categoraa,
            'form' => $form,
            
            ]);
            
        } else {
            return $this->renderForm('categoraa/index.html.twig', [
            
            //'catik' => $catik,
            
            'categor' => $categoraaRepository->findAll(),
            'categoraa' => $categoraa,
            'form' => $form,
            ]);
            //'categor' => $categoraaRepository->findOneBy()
        }
    }
            return $this->renderForm('categoraa/index.html.twig', [
            
            //'catik' => $catik,
            
            'categor' => $categoraaRepository->findAll(),
            'categoraa' => $categoraa,
            'form' => $form,
            ]);
    
    }

    /**
     * @Route("/new", name="categoraa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categoraa = new Categoraa();


        $food = new Categoraa();
        $food->setTitle('Food');

        $fruits = new Categoraa();
        $fruits->setTitle('Fruits');
        $fruits->setParent($food);

        $vegetables = new Categoraa();
        $vegetables->setTitle('Vegetables');
        $vegetables->setParent($food);

        $carrots = new Categoraa();
        $carrots->setTitle('Carrots');
        $carrots->setParent($vegetables);

        $em = $this->getDoctrine()->getManager();

        $em->persist($food);
        $em->persist($fruits);
        $em->persist($vegetables);
        $em->persist($carrots);
        $em->flush();


        /*$home = new Categoraa();
        $home->setTitle('Home');
        $bikes = new Categoraa();
        $bikes->setTitle('Bikes');
        $bikes->setParent($home);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($home);
        $entityManager->persist($bikes);

        $entityManager->flush();*/
        

        $form = $this->createForm(CategoraaType::class, $categoraa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categoraa);
            $entityManager->flush();

            return $this->redirectToRoute('categoraa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoraa/new.html.twig', [
            'categoraa' => $categoraa,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categoraa_show", methods={"GET"})
     */
    public function show(Categoraa $categoraa): Response
    {
        return $this->render('categoraa/show.html.twig', [
            'categoraa' => $categoraa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categoraa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categoraa $categoraa): Response
    {
        $form = $this->createForm(CategoraaType::class, $categoraa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categoraa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoraa/edit.html.twig', [
            'categoraa' => $categoraa,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="categoraa_delete", methods={"POST"})
     */
    public function delete(Request $request, Categoraa $categoraa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoraa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categoraa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categoraa_index', [], Response::HTTP_SEE_OTHER);
    }
}
