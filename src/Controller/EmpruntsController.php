<?php

namespace App\Controller;

use App\Entity\Emprunts;
use App\Form\EmpruntsType;
use App\Repository\EmpruntsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpruntsController extends Controller
{
    /**
     * @Route("/emprunts/", name="emprunts_index")
     */
    public function index(EmpruntsRepository $empruntsRepository): Response
    {
        return $this->render('emprunts/index.html.twig', ['emprunts' => $empruntsRepository->findAll()]);
    }

    /**
     * @Route("/emprunts/new", name="emprunts_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $emprunt = new Emprunts();
        $form = $this->createForm(EmpruntsType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emprunt);
            $em->flush();

            return $this->redirectToRoute('emprunts_index');
        }

        return $this->render('emprunts/new.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/emprunts/{id}", name="emprunts_show", methods="GET")
     */
    public function show(Emprunts $emprunt): Response
    {
        return $this->render('emprunts/show.html.twig', ['emprunt' => $emprunt]);
    }

    /**
     * @Route("/emprunts/{id}/edit", name="emprunts_edit", methods="GET|POST")
     */
    public function edit(Request $request, Emprunts $emprunt): Response
    {
        $form = $this->createForm(EmpruntsType::class, $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emprunts_edit', ['id' => $emprunt->getId()]);
        }

        return $this->render('emprunts/edit.html.twig', [
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/emprunts/{id}", name="emprunts_delete", methods="DELETE")
     */
    public function delete(Request $request, Emprunts $emprunt): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emprunt->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emprunt);
            $em->flush();
        }

        return $this->redirectToRoute('emprunts_index');
    }
}
