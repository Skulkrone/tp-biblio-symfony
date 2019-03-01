<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdherentsRepository")
 */
class Adherents
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Emprunts", mappedBy="fkadherents")
     */
    private $empruntsLivre;

    public function __construct()
    {
        $this->empruntsLivre = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Emprunts[]
     */
    public function getEmpruntsLivre(): Collection
    {
        return $this->empruntsLivre;
    }

    public function addEmpruntsLivre(Emprunts $empruntsLivre): self
    {
        if (!$this->empruntsLivre->contains($empruntsLivre)) {
            $this->empruntsLivre[] = $empruntsLivre;
            $empruntsLivre->setFkadherents($this);
        }

        return $this;
    }

    public function removeEmpruntsLivre(Emprunts $empruntsLivre): self
    {
        if ($this->empruntsLivre->contains($empruntsLivre)) {
            $this->empruntsLivre->removeElement($empruntsLivre);
            // set the owning side to null (unless already changed)
            if ($empruntsLivre->getFkadherents() === $this) {
                $empruntsLivre->setFkadherents(null);
            }
        }

        return $this;
    }
}
