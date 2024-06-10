<?php

namespace App\Entity;

use App\Repository\AlimentationJourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlimentationJourRepository::class)]
class AlimentationJour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nourriture = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quantite = null;

    #[ORM\OneToOne(mappedBy: 'AlimentationJour', cascade: ['persist', 'remove'])]
    private ?Animal $animal = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'AlimentationJour')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNourriture(): ?string
    {
        return $this->nourriture;
    }

    public function setNourriture(?string $nourriture): static
    {
        $this->nourriture = $nourriture;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(?\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        // unset the owning side of the relation if necessary
        if ($animal === null && $this->animal !== null) {
            $this->animal->setAlimentationJour(null);
        }

        // set the owning side of the relation if necessary
        if ($animal !== null && $animal->getAlimentationJour() !== $this) {
            $animal->setAlimentationJour($this);
        }

        $this->animal = $animal;

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
            $user->setAlimentationJour($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAlimentationJour() === $this) {
                $user->setAlimentationJour(null);
            }
        }

        return $this;
    }
}
