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
    #[Route('/api/new_user', name: 'new_user')]
    public function addPhotographer(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        // Création d'un nouvel objet Photographer
        $photographer = new Photographers();
        
        // Création d'un formulaire pour l'objet Photographer
        $form = $this->createForm(PhotographerType::class, $photographer);
        $form->submit($request->request->all());

        // Validation du formulaire
        if ($form->isValid()) {
            // Enregistrement de l'objet Photographer en base de données
            $entityManager->persist($photographer);
            $entityManager->flush();
            
            // Renvoi de la réponse au format JSON
            $jsonPhotographer = $serializer->serialize($photographer, 'json');
            return new Response($jsonPhotographer, Response::HTTP_CREATED, [
                'Content-Type' => 'application/json'
            ]);
        }

        // En cas d'erreur de validation du formulaire, renvoi d'une réponse avec les erreurs
        $errors = [];
        foreach ($form->getErrors(true) as $error) {
            $propertyPath = $error->getOrigin()->getPropertyPath();
            $errors[$propertyPath] = $error->getMessage();
        }
        $jsonErrors = $serializer->serialize($errors, 'json');
        return new Response($jsonErrors, Response::HTTP_BAD_REQUEST, [
            'Content-Type' => 'application/json'
        ]);
    }
}
