<?php

namespace App\Controller;

use App\Entity\Photographers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    // #[Route('/api/reset-password', name: 'reset-password')]
    // public function resetPassword(Request $request)
    // {
    //     $entityManager = $this->getDoctrine()->getManager();

    //     // Get the email address submitted by the user
    //     $email = $request->request->get('email');

    //     // Check if a photographer with the submitted email address exists in the database
    //     $photographer = $entityManager->getRepository(Photographer::class)->findOneBy(['email' => $email]);

    //     if (!$photographer) {
    //         // If no photographer is found, return an error message
    //         return $this->json(['message' => 'No photographer found with this email address.'], 404);
    //     }


    //     $entityManager->flush();

    //     // Send an email to the photographer with the new password
    //     // Code for sending the email goes here...

    //     // Return a success message
    //     return $this->json(['message' => 'Password reset successfully.']);
    // }
}
