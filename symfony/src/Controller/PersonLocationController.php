<?php

namespace App\Controller;

use App\Entity\PersonLocation;
use App\Entity\User;
use App\Form\PersonLocationType;
use App\Repository\PersonLocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/person_location")
 */
class PersonLocationController extends AbstractController
{
    /**
     * @Route("/", name="person_location_index", methods={"GET"})
     */
    public function index(PersonLocationRepository $personLocationRepository): Response
    {
        return $this->render('person_location/index.html.twig', [
            'person_locations' => $personLocationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="person_location_new", methods={"GET","POST"})
     */
    public function new(User $user, Request $request): Response
    {
        $personLocation = new PersonLocation();
        $personLocation->setUser($user);
        $form = $this->createForm(PersonLocationType::class, $personLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personLocation);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('person_location/new.html.twig', [
            'person_location' => $personLocation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person_location_show", methods={"GET"})
     */
    public function show(PersonLocation $personLocation): Response
    {
        return $this->render('person_location/show.html.twig', [
            'person_location' => $personLocation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="person_location_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonLocation $personLocation): Response
    {
        $form = $this->createForm(PersonLocationType::class, $personLocation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_location_index');
        }

        return $this->render('person_location/edit.html.twig', [
            'person_location' => $personLocation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person_location_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PersonLocation $personLocation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personLocation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personLocation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('person_location_index');
    }
}
