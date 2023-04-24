<?php

namespace App\Controller;

use App\Entity\Photographers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    #[Route('/api/user_connect', name: 'user_connect')]
    public function getUserByConnect(SerializerInterface $serializer): JsonResponse
    {
        $userConnected = $this->getUser();
        $jsonUser = $serializer->serialize($userConnected, 'json');

        return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
    }

    #[Route("api/register", name: "register", methods: ['POST'])]

    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Photographers();
        $user->setEmail($request->get('email'));
        $user->setRoles(['ROLE_PHOTOGRAPHER']);
        $user->setPassword($passwordHasher->hashPassword($user, $request->get('password')));

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('Photographe created', Response::HTTP_CREATED);
    }
}
