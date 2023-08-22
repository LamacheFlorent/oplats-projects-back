<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeAPI;

    /**
     * @ORM\OneToMany(targetEntity=Review::class, mappedBy="recipe")
     */
    private $review;

    public function __construct()
    {
        $this->review = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeAPI(): ?int
    {
        return $this->codeAPI;
    }

    public function setCodeAPI(int $codeAPI): self
    {
        $this->codeAPI = $codeAPI;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReview(): Collection
    {
        return $this->review;
    }

    public function addReview(Review $review): self
    {
        if (!$this->review->contains($review)) {
            $this->review[] = $review;
            $review->setRecipe($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->review->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getRecipe() === $this) {
                $review->setRecipe(null);
            }
        }

        return $this;
    }
}
