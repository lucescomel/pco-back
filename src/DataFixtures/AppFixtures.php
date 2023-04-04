<?php

namespace App\DataFixtures;

use App\Entity\Availablities;
use App\Entity\Bookings;
use App\Entity\Clients;
use App\Entity\Photographers;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{

    private $userPasswordHasher;
    
    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'un photographe
        $photographer = new Photographers();
        $photographer->setEmail("lucescomel@outlook.fr");
        $photographer->setPassword($this->userPasswordHasher->hashPassword($photographer, "password"));
        $photographer->setRoles(['ROLE_PHOTOGRAPHER']);

        $manager->persist($photographer);
        $manager->flush();

        $listClients = [];
        for ($i = 0; $i < 10; $i++) {
        // Ajout d'un client pour ce photographe
        $client = new Clients();
        $client->setName("John Doe");
        $client->setEmail("johndoe@example.com");
        $client->setPhone(1234567890);
        $client->setPhotographer($photographer);

        $manager->persist($client);
        $manager->flush();
        // On sauvegarde l'auteur créé dans un tableau.
        $listClients[] = $client;
        }

        $listBookings = [];
        for ($j = 0; $j < 10; $j++) {
        //Ajout d'une réservation 
        $booking = new Bookings();
        $booking->setBookingStart(new DateTime('2023-04-05 10:00:00'));
        $booking->setBookingEnd(new DateTime('2023-04-05 12:00:00'));
        $booking->setClient($client);
        $booking->setPhotographer($photographer);
       
        $manager->persist($booking);
        $manager->flush();
        //On sauvegarde la réservation créé dans un tableau
        $listBookings[] = $booking;
        }

        $listAvailablities = [];
        for ($i = 0; $i < 5; $i++) {
            $availability = new Availablities();
            $availability->setDay($i + 1)
                         ->setFreeStart(new \DateTime('10:00:00'))
                         ->setFreeEnd(new \DateTime('18:00:00'))
                         ->setPhotographer($photographer);
            $manager->persist($availability);
            $manager->flush();

            $listAvailablities[] = $availability;
        }
    }
    
}
