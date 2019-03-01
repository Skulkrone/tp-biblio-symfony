<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivreRepository")
 */
class Livre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Emprunts", mappedBy="fklivre")
     */
    private $empruntsAdherents;

    public function __construct()
    {
        $this->empruntsAdherents = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Emprunts[]
     */
    public function getEmpruntsAdherents(): Collection
    {
        return $this->empruntsAdherents;
    }

    public function addEmpruntsAdherent(Emprunts $empruntsAdherent): self
    {
        if (!$this->empruntsAdherents->contains($empruntsAdherent)) {
            $this->empruntsAdherents[] = $empruntsAdherent;
            $empruntsAdherent->setFklivre($this);
        }

        return $this;
    }

    public function removeEmpruntsAdherent(Emprunts $empruntsAdherent): self
    {
        if ($this->empruntsAdherents->contains($empruntsAdherent)) {
            $this->empruntsAdherents->removeElement($empruntsAdherent);
            // set the owning side to null (unless already changed)
            if ($empruntsAdherent->getFklivre() === $this) {
                $empruntsAdherent->setFklivre(null);
            }
        }

        return $this;
    }
}
