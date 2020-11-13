<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="user")
     */
    public function register(UserPasswordEncoderInterface $passwordEncoder, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form->getData()->getPassword()
            ));

            $roles = $form->get('roles')->getData();
            if ($roles) {
                $user->setRoles(['ROLE_ADMIN']);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('user/register.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param User $user
     * @Route("/profile/{id}", name="profile")
     */
    public function profile(User $user)
    {
        return $this->render('user/profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @Route("/profile/{id}/edit", name="profile_edit")
     */
    public function edit(User $user, Request $request)
    {
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('profile', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
