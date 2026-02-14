<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SchoolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchoolRepository::class)]
class School
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $whatsapp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $aboutText = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $mission = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $vision = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $principalMessage = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }
    public function getAddress(): ?string { return $this->address; }
    public function setAddress(string $address): static { $this->address = $address; return $this; }
    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): static { $this->phone = $phone; return $this; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): static { $this->email = $email; return $this; }
    public function getWhatsapp(): ?string { return $this->whatsapp; }
    public function setWhatsapp(?string $whatsapp): static { $this->whatsapp = $whatsapp; return $this; }
    public function getLogo(): ?string { return $this->logo; }
    public function setLogo(?string $logo): static { $this->logo = $logo; return $this; }
    public function getAboutText(): ?string { return $this->aboutText; }
    public function setAboutText(?string $aboutText): static { $this->aboutText = $aboutText; return $this; }
    public function getMission(): ?string { return $this->mission; }
    public function setMission(?string $mission): static { $this->mission = $mission; return $this; }
    public function getVision(): ?string { return $this->vision; }
    public function setVision(?string $vision): static { $this->vision = $vision; return $this; }
    public function getPrincipalMessage(): ?string { return $this->principalMessage; }
    public function setPrincipalMessage(?string $principalMessage): static { $this->principalMessage = $principalMessage; return $this; }
}