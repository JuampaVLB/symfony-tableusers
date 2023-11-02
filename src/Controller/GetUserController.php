<?php

namespace App\Controller;

use \App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GetUserController extends AbstractController
{
    #[Route('/get/user/{id}', name: 'app_get_user')]
    public function index(EntityManagerInterface $entityManager, $id): Response
    {
        $userRepository = $entityManager->getRepository(User::class);
        $user = $userRepository->find($id);
        return $this->render('get_user/index.html.twig', [
            'controller_name' => 'GetUserController',
            'user' => $user
            
        ]);
    }
}
