<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmpruntsRepository")
 */
class Emprunts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Livre", inversedBy="empruntsAdherents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fklivre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adherents", inversedBy="empruntsLivre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fkadherents;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEmprunt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRetour;

    public function getId()
    {
        return $this->id;
    }

    public function getFklivre(): ?Livre
    {
        return $this->fklivre;
    }

    public function setFklivre(?Livre $fklivre): self
    {
        $this->fklivre = $fklivre;

        return $this;
    }

    public function getFkadherents(): ?Adherents
    {
        return $this->fkadherents;
    }

    public function setFkadherents(?Adherents $fkadherents): self
    {
        $this->fkadherents = $fkadherents;

        return $this;
    }

    public function getDateEmprunt(): ?\DateTimeInterface
    {
        return $this->dateEmprunt;
    }

    public function setDateEmprunt(\DateTimeInterface $dateEmprunt): self
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }
}
