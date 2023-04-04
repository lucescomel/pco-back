<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BookingsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingsRepository::class)]
#[ApiResource]
class Bookings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $booking_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $booking_end = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clients $client = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Photographers $photographer = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingStart(): ?\DateTimeInterface
    {
        return $this->booking_start;
    }

    public function setBookingStart(\DateTimeInterface $booking_start): self
    {
        $this->booking_start = $booking_start;

        return $this;
    }

    public function getBookingEnd(): ?\DateTimeInterface
    {
        return $this->booking_end;
    }

    public function setBookingEnd(\DateTimeInterface $booking_end): self
    {
        $this->booking_end = $booking_end;

        return $this;
    }

    public function getClient(): ?Clients
    {
        return $this->client;
    }

    public function setClient(?Clients $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPhotographer(): ?Photographers
    {
        return $this->photographer;
    }

    public function setPhotographer(?Photographers $photographer): self
    {
        $this->photographer = $photographer;

        return $this;
    }

}
