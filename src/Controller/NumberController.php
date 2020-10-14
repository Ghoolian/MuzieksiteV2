<?php

namespace App\Controller;

use App\Entity\Number;
use App\Form\NumberType;
use App\Repository\NumberRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/number")
 */
class NumberController extends AbstractController
{
    /**
     * @Route("/", name="number_index", methods={"GET"})
     * @param NumberRepository $numberRepository
     * @return Response
     */
    public function index(NumberRepository $numberRepository): Response
    {
        return $this->render('number/index.html.twig', [
            'number' => $numberRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="number_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $number = new Number();
        $form = $this->createForm(NumberType::class, $number);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($number);
            $entityManager->flush();

            return $this->redirectToRoute('number_index');
        }

        return $this->render('number/new.html.twig', [
            'number' => $number,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="number_show", methods={"GET"})
     */
    public function show(Number $number): Response
    {
        return $this->render('number/show.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="number_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Number $number): Response
    {
        $form = $this->createForm(NumberType::class, $number);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($number);
            $entityManager->flush();

            return $this->redirectToRoute('number_index');
        }

        return $this->render('number/edit.html.twig', [
            'number' => $number,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="number_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Number $number): Response
    {
        if ($this->isCsrfTokenValid('delete'.$number->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($number);
            $entityManager->flush();
        }

        return $this->redirectToRoute('number_index');
    }
}