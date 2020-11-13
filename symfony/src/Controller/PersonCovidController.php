<?php

namespace App\Controller;

use App\Entity\PersonCovid;
use App\Form\PersonCovidType;
use App\Repository\PersonCovidRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/person_covid")
 */
class PersonCovidController extends AbstractController
{
    /**
     * @Route("/", name="person_covid_index", methods={"GET"})
     */
    public function index(PersonCovidRepository $personCovidRepository): Response
    {
        return $this->render('person_covid/index.html.twig', [
            'person_covids' => $personCovidRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="person_covid_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $personCovid = new PersonCovid();
        $form = $this->createForm(PersonCovidType::class, $personCovid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personCovid);
            $entityManager->flush();

            return $this->redirectToRoute('person_covid_index');
        }

        return $this->render('person_covid/new.html.twig', [
            'person_covid' => $personCovid,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person_covid_show", methods={"GET"})
     */
    public function show(PersonCovid $personCovid): Response
    {
        return $this->render('person_covid/show.html.twig', [
            'person_covid' => $personCovid,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="person_covid_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PersonCovid $personCovid): Response
    {
        $form = $this->createForm(PersonCovidType::class, $personCovid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('person_covid_index');
        }

        return $this->render('person_covid/edit.html.twig', [
            'person_covid' => $personCovid,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="person_covid_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PersonCovid $personCovid): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personCovid->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personCovid);
            $entityManager->flush();
        }

        return $this->redirectToRoute('person_covid_index');
    }
}
