<?php

namespace App\Entity\Person;

use App\Entity\Apartments\Apartment;
use App\Model\Person\PersonModel;
use App\Repository\Person\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use function Symfony\Component\Translation\t;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255,)]
    private string $firstName;

    #[ORM\Column(length: 255)]
    private string $lastName;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column]
    private string $phone;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: Apartment::class)]
    private Collection $apartment;

    public function __construct()
    {
        $this->apartment = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return Collection
     */
    public function getApartment(): Collection
    {
        return $this->apartment;
    }

    public function addApartment(Apartment $apartment): void
    {
        $this->getApartment()->add($apartment);
    }

    public function removeApartment(Apartment $apartment): void
    {
        $this->getApartment()->remove($apartment);
    }

    public function mapFromModel(PersonModel $personModel): void
    {
        $this->setFirstName($personModel->firstName);
        $this->setLastName($personModel->lastName);
        $this->setEmail($personModel->email);
        $this->setPhone($personModel->phone);
    }

}
