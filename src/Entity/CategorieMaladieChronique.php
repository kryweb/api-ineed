<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CategorieMaladieChroniqueRepository")
 */
class CategorieMaladieChronique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MaladieChronique", mappedBy="categorieMaladieChronique")
     */
    private $MaladieChronique;

    public function __construct()
    {
        $this->MaladieChronique = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|MaladieChronique[]
     */
    public function getMaladieChronique(): Collection
    {
        return $this->MaladieChronique;
    }

    public function addMaladieChronique(MaladieChronique $maladieChronique): self
    {
        if (!$this->MaladieChronique->contains($maladieChronique)) {
            $this->MaladieChronique[] = $maladieChronique;
            $maladieChronique->setCategorieMaladieChronique($this);
        }

        return $this;
    }

    public function removeMaladieChronique(MaladieChronique $maladieChronique): self
    {
        if ($this->MaladieChronique->contains($maladieChronique)) {
            $this->MaladieChronique->removeElement($maladieChronique);
            // set the owning side to null (unless already changed)
            if ($maladieChronique->getCategorieMaladieChronique() === $this) {
                $maladieChronique->setCategorieMaladieChronique(null);
            }
        }

        return $this;
    }
}
