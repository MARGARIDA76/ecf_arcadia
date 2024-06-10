<?php

namespace App\Entity;

use App\Repository\RapportAnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RapportAnimalRepository::class)]
class RapportAnimal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $etat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nourriturePropose = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $grammageNourriture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $detailEtatAnimal = null;

    /**
     * @var Collection<int, Animal>
     */
    #[ORM\OneToMany(targetEntity: Animal::class, mappedBy: 'RapportAnimal')]
    private Collection $animals;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'RapportAnimal')]
    private Collection $users;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNourriturePropose(): ?string
    {
        return $this->nourriturePropose;
    }

    public function setNourriturePropose(?string $nourriturePropose): static
    {
        $this->nourriturePropose = $nourriturePropose;

        return $this;
    }

    public function getGrammageNourriture(): ?string
    {
        return $this->grammageNourriture;
    }

    public function setGrammageNourriture(?string $grammageNourriture): static
    {
        $this->grammageNourriture = $grammageNourriture;

        return $this;
    }

    public function getDetailEtatAnimal(): ?string
    {
        return $this->detailEtatAnimal;
    }

    public function setDetailEtatAnimal(?string $detailEtatAnimal): static
    {
        $this->detailEtatAnimal = $detailEtatAnimal;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setRapportAnimal($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getRapportAnimal() === $this) {
                $animal->setRapportAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setRapportAnimal($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getRapportAnimal() === $this) {
                $user->setRapportAnimal(null);
            }
        }

        return $this;
    }
}
