<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $propertyKey;

    /**
     * @ORM\Column(type="string", length=10000)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=ProductProperty::class, mappedBy="property")
     */
    private $productProperties;

    public function __construct()
    {
        $this->productProperties = new ArrayCollection();
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

    public function getPropertyKey(): ?string
    {
        return $this->propertyKey;
    }

    public function setPropertyKey(string $propertyKey): self
    {
        $this->propertyKey = $propertyKey;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|ProductProperty[]
     */
    public function getProductProperties(): Collection
    {
        return $this->productProperties;
    }

    public function addProductProperty(ProductProperty $productProperty): self
    {
        if (!$this->productProperties->contains($productProperty)) {
            $this->productProperties[] = $productProperty;
            $productProperty->setProperty($this);
        }

        return $this;
    }

    public function removeProductProperty(ProductProperty $productProperty): self
    {
        if ($this->productProperties->removeElement($productProperty)) {
            // set the owning side to null (unless already changed)
            if ($productProperty->getProperty() === $this) {
                $productProperty->setProperty(null);
            }
        }

        return $this;
    }
}
