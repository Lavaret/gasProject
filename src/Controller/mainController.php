<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\GasReport;
use App\Entity\GasOptions;
use App\Service\ReportGenerator;
use App\Form\GasReportType;
use App\Form\GasOptionsType;


class mainController extends Controller
{
    /**
     * @Route("/", name="base")
     */
    public function mainAction()
    {

        return $this->render('base.html.twig');
    }

    

    /**
     * @Route("/report", name="new_report")
     */
    public function repotrAction(Request $request, ReportGenerator $reportGenerator)
    {
        $gasReport = new gasReport();
        $form = $this->createForm(GasReportType::class, $gasReport);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $formData = $form->getData();
            $gasReport = $reportGenerator->setDataForReport($formData);
            $reportGenerator->actualizeOptions($formData);
            $em->persist($gasReport);
            $em->flush();

            return $this->redirectToRoute('report_show');
        }

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Nowy raport'
        ));
    }

    /**
     * @Route("/show", name="report_show")
     */
    public function showAction()
    {
        $repository = $this->getDoctrine()->getRepository(GasReport::class);
        $gasReports = $repository->findAll();

        return $this->render('report.html.twig', array(
            'gasReports' => $gasReports
        ));
    }

        /**
     * @Route("/edit/{id}", name="report_edit")
     */
    public function editAction(GasReport $gasReport, Request $request, ReportGenerator $reportGenerator)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(GasReportType::class, $gasReport);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $gasReportChanged = $form->getData();
            $gasReport = $reportGenerator->editDataInReport($gasReportChanged);
            $em->persist($gasReport);
            $em->flush();

            return $this->redirectToRoute('report_show');
        }

        return $this->render('new.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Edytuj raport'
        ));
    }

        /**
     * @Route("/delete/{id}", name="report_delete")
     */
    public function deleteAction(GasReport $gasReport)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($gasReport);
        $em->flush();

        $repository = $this->getDoctrine()->getRepository(GasReport::class);
        $gasReports = $repository->findAll();
        return $this->render('report.html.twig', array(
            'gasReports' => $gasReports
        ));
    }
}