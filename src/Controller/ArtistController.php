<?php


namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/", name="artist_index", methods={"GET"})
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('artiesten/index.html.twig', [
            'artiestens' => $artistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="artiesten_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $artiesten = new Artist();
        $form = $this->createForm(ArtistType::class, $artiesten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($artiesten);
            $entityManager->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/new.html.twig', [
            'artiesten' => $artiesten,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artiesten_show", methods={"GET"})
     */
    public function show(Artist $artiesten): Response
    {
        return $this->render('artist/show.html.twig', [
            'artiesten' => $artiesten,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artiesten_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Artist $artiesten): Response
    {
        $form = $this->createForm(ArtistType::class, $artiesten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/edit.html.twig', [
            'artiesten' => $artiesten,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="artiesten_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Artist $artiesten): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artiesten->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($artiesten);
            $entityManager->flush();
        }

        return $this->redirectToRoute('artist_index');
    }
}