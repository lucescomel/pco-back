<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
}
