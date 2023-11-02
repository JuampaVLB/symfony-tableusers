<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use \App\Entity\User;
use \App\Form\UserType;

// use \App\Controller\CreateUserController::getDoctrine;

class CreateUserController extends AbstractController
{
    #[Route('/create/user', name: 'app_create_user')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $em = $this->getDoctrine()->getManager();
            $entityManager = $doctrine->getManager();
            $entityManager = $doctrine->getManager('default');
            $entityManager->persist($user);
            $entityManager->flush();
            $test = $form->getData();
            $this->addFlash(type: 'success', message: 'se registro correctamente');
            return $this->redirectToRoute('app_create_user');
        }

        return $this->render('create_user/index.html.twig', [
            'controller_name' => 'CreateUserController',
            'formulario' => $form->createView(),
        ]);
    }
}
