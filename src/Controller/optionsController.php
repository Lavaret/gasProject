<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\GasOptions;
use App\Form\GasOptionsType;

/**
 * @Route("/options")
 */
class optionsController extends Controller
{
	/**
     * @Route("/new", name="options_new")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $gasOptions = new GasOptions();
        
        $form = $this->createForm(GasOptionsType::class, $gasOptions);
        $form->handleRequest($request);
 
        if($form->isSubmitted() && $form->isValid())
        {
        	$gasOptions = $form->getData();
            $em->persist($gasOptions);
            $em->flush();

            return $this->redirectToRoute('options_show');
        }

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/edit/{id}", name="options_edit")
     */
    public function editAction(Request $request, GasOptions $gasOptions)
    {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(GasOptionsType::class, $gasOptions);
        $form->handleRequest($request);
 
        if($form->isSubmitted() && $form->isValid())
        {
            $gasOptionsChanged = $form->getData();
            $em->persist($gasOptionsChanged);
            $em->flush();

            return $this->redirectToRoute('options_show');
        }

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Utwórz nowe opcje'
        ));
    }


    /**
     * @Route("/show", name="options_show")
     */
    public function showAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(GasOptions::class);
        $gasOptions = $repository->findAll();

        return $this->render('options/show.html.twig', array(
            'gasOptions' => $gasOptions
        ));
    }
}