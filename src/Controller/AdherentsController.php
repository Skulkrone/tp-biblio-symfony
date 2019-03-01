<?php

namespace App\Controller;

use App\Entity\Adherents;
use App\Form\AdherentsType;
use App\Repository\AdherentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdherentsController extends Controller
{
    /**
     * @Route("/adherents" ,name="adherents_index", methods="GET")
     */
    public function index(AdherentsRepository $adherentsRepository): Response
    {
        return $this->render('adherents/index.html.twig', ['adherents' => $adherentsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="adherents_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $adherent = new Adherents();
        $form = $this->createForm(AdherentsType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adherent);
            $em->flush();

            return $this->redirectToRoute('adherents_index');
        }

        return $this->render('adherents/new.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adherents_show", methods="GET")
     */
    public function show(Adherents $adherent): Response
    {
        return $this->render('adherents/show.html.twig', ['adherent' => $adherent]);
    }

    /**
     * @Route("/{id}/edit", name="adherents_edit", methods="GET|POST")
     */
    public function edit(Request $request, Adherents $adherent): Response
    {
        $form = $this->createForm(AdherentsType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adherents_edit', ['id' => $adherent->getId()]);
        }

        return $this->render('adherents/edit.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adherents_delete", methods="DELETE")
     */
    public function delete(Request $request, Adherents $adherent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adherent->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adherent);
            $em->flush();
        }

        return $this->redirectToRoute('adherents_index');
    }
}
