<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AvailablitiesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity(repositoryClass: AvailablitiesRepository::class)]
#[ApiResource]
class Availablities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $day = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $free_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $free_end = null;

    #[ORM\ManyToOne(inversedBy: 'availablities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Photographers $photographer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(int $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getFreeStart(): ?\DateTimeInterface
    {
        return $this->free_start;
    }

    public function setFreeStart(\DateTimeInterface $free_start): self
    {
        $this->free_start = $free_start;

        return $this;
    }

    public function getFreeEnd(): ?\DateTimeInterface
    {
        return $this->free_end;
    }

    public function setFreeEnd(\DateTimeInterface $free_end): self
    {
        $this->free_end = $free_end;

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
