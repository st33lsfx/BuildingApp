<?php

namespace App\Entity\Apartments;

use App\Entity\Building\Building;
use App\Entity\Person\Person;
use App\Model\Apartment\ApartmentModel;
use App\Repository\Apartment\ApartmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApartmentRepository::class)]
class Apartment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?int $size = null;

    #[ORM\Column(nullable: true)]
    private ?float $coldWaterStatus = null;

    #[ORM\Column(nullable: true)]
    private ?float $hotWaterStatus = null;

    #[ORM\Column(nullable: true)]
    private ?float $gasMeterStatus = null;

    #[ORM\Column(nullable: true)]
    private ?float $squareStatus = null;

    #[ORM\ManyToOne(inversedBy: 'apartment')]
    #[ORM\JoinColumn(name: 'building_id', referencedColumnName: 'id', nullable: false)]
    private Building $building;

    #[ORM\ManyToOne(inversedBy: 'apartment')]
    #[ORM\JoinColumn(name: 'person_id', referencedColumnName: 'id', nullable: true)]
    private ?Person $person = null;

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getColdWaterStatus(): ?float
    {
        return $this->coldWaterStatus;
    }

    public function setColdWaterStatus(?float $coldWaterStatus): self
    {
        $this->coldWaterStatus = $coldWaterStatus;

        return $this;
    }

    public function getHotWaterStatus(): ?float
    {
        return $this->hotWaterStatus;
    }

    public function setHotWaterStatus(?float $hotWaterStatus): self
    {
        $this->hotWaterStatus = $hotWaterStatus;

        return $this;
    }

    public function getGasMeterStatus(): ?float
    {
        return $this->gasMeterStatus;
    }

    public function setGasMeterStatus(?float $gasMeterStatus): self
    {
        $this->gasMeterStatus = $gasMeterStatus;

        return $this;
    }

    public function getSquareStatus(): ?float
    {
        return $this->squareStatus;
    }

    public function setSquareStatus(?float $squareStatus): self
    {
        $this->squareStatus = $squareStatus;

        return $this;
    }

    public function getBuilding(): Building
    {
        return $this->building;
    }

    public function setBuilding(Building $building): void
    {
        $this->building = $building;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): void
    {
        $this->person = $person;
    }

    public function mapFromModel(ApartmentModel $apartmentModel): void
    {
        $this->setTitle($apartmentModel->title);
        $this->setBuilding($apartmentModel->building);
        $this->setPerson($apartmentModel->person);
        $this->setSize($apartmentModel->size);
        $this->setColdWaterStatus($apartmentModel->coldWaterStatus);
        $this->setHotWaterStatus($apartmentModel->hotWaterStatus);
        $this->setGasMeterStatus($apartmentModel->gasMeterStatus);
        $this->setSquareStatus($apartmentModel->squareStatus);
    }
}
