<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\User;
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
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="livres")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="emprunts_en_cours")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="livres_lus")
     */
    private $ancient_users;

    public function __construct()
    {
        $this->ancient_users = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getAncientUsers(): Collection
    {
        return $this->ancient_users;
    }

    public function addAncientUser(User $ancientUser): self
    {
        if (!$this->ancient_users->contains($ancientUser)) {
            $this->ancient_users[] = $ancientUser;
        }

        return $this;
    }

    public function removeAncientUser(User $ancientUser): self
    {
        if ($this->ancient_users->contains($ancientUser)) {
            $this->ancient_users->removeElement($ancientUser);
        }

        return $this;
    }
    public function __toString()
{
   return $this->getNom();
}
}
