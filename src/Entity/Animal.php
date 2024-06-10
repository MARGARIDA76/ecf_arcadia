<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[Vich\Uploadable]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $race = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[Vich\UploadableField(mapping: 'animal', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\OneToOne(inversedBy: 'animal', cascade: ['persist', 'remove'])]
    private ?AlimentationJour $AlimentationJour = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?RapportAnimal $RapportAnimal = null;

    /**
     * @var Collection<int, Habitat>
     */
    #[ORM\OneToMany(targetEntity: Habitat::class, mappedBy: 'animal')]
    #[ORM\JoinColumn(name: 'habitat_id', referencedColumnName: 'id', nullable: false)]
    private Collection $Habitat;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'animal')]
    private Collection $Avis;

    public function __construct()
    {
        $this->Habitat = new ArrayCollection();
        $this->Avis = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(?string $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): static
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function getAlimentationJour(): ?AlimentationJour
    {
        return $this->AlimentationJour;
    }

    public function setAlimentationJour(?AlimentationJour $AlimentationJour): static
    {
        $this->AlimentationJour = $AlimentationJour;

        return $this;
    }

    public function getRapportAnimal(): ?RapportAnimal
    {
        return $this->RapportAnimal;
    }

    public function setRapportAnimal(?RapportAnimal $RapportAnimal): static
    {
        $this->RapportAnimal = $RapportAnimal;

        return $this;
    }

    /**
     * @return Collection<int, Habitat>
     */
    public function getHabitat(): Collection
    {
        return $this->Habitat;
    }

    public function addHabitat(Habitat $habitat): static
    {
        if (!$this->Habitat->contains($habitat)) {
            $this->Habitat->add($habitat);
            $habitat->setAnimal($this);
        }

        return $this;
    }

    public function removeHabitat(Habitat $habitat): static
    {
        if ($this->Habitat->removeElement($habitat)) {
            // set the owning side to null (unless already changed)
            if ($habitat->getAnimal() === $this) {
                $habitat->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->Avis;
    }

    public function addAvi(Avis $avi): static
    {
        if (!$this->Avis->contains($avi)) {
            $this->Avis->add($avi);
            $avi->setAnimal($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): static
    {
        if ($this->Avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getAnimal() === $this) {
                $avi->setAnimal(null);
            }
        }

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

}
