<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=3000)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="integer")
     */
    private $basePrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $discPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $accessOddment;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $componentsComport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consumableWare;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    private $productProperty; 

    /**
     * @ORM\OneToMany(targetEntity=ProductProperty::class, mappedBy="product")
     */
    private $productProperties;

    /**
     * @ORM\OneToMany(targetEntity=ProductPhoto::class, mappedBy="product")
     */
    private $productPhotos;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->productProperties = new ArrayCollection();
        $this->productPhotos = new ArrayCollection();
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getBasePrice(): ?int
    {
        return $this->basePrice;
    }

    public function setBasePrice(int $basePrice): self
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    public function getDiscPrice(): ?int
    {
        return $this->discPrice;
    }

    public function setDiscPrice(?int $discPrice): self
    {
        $this->discPrice = $discPrice;

        return $this;
    }

    public function getAccessOddment(): ?int
    {
        return $this->accessOddment;
    }

    public function setAccessOddment(int $accessOddment): self
    {
        $this->accessOddment = $accessOddment;

        return $this;
    }

    public function getComponentsComport(): ?string
    {
        return $this->componentsComport;
    }

    public function setComponentsComport(?string $componentsComport): self
    {
        $this->componentsComport = $componentsComport;

        return $this;
    }

    public function getConsumableWare(): ?string
    {
        return $this->consumableWare;
    }

    public function setConsumableWare(?string $consumableWare): self
    {
        $this->consumableWare = $consumableWare;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|ProductProperty[]
     */
    public function getProductProperties(): Collection
    {
        return $this->productProperties;
    }

    public function addProductProperties(ProductProperty $productProperty): self
    {
        if (!$this->productProperties->contains($productProperty)) {
            $this->productProperties[] = $productProperty;
            $productProperty->setProduct($this);
        }

        return $this;
    }

    public function removeProductProperties(ProductProperty $productProperty): self
    {
        if ($this->productProperties->removeElement($productProperties)) {
            // set the owning side to null (unless already changed)
            if ($productProperties->getProduct() === $this) {
                $productProperties->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductPhoto[]
     */
    public function getProductPhotos(): Collection
    {
        return $this->productPhotos;
    }

    public function addProductPhotos(ProductPhoto $productPhoto): self
    {
        if (!$this->productPhotos->contains($productPhoto)) {
            $this->productPhotos[] = $productPhoto;
            $productPhoto->setProduct($this);
        }

        return $this;
    }

    public function removeProductPhotos(ProductPhoto $productPhotos): self
    {
        if ($this->productPhotos->removeElement($productPhotos)) {
            // set the owning side to null (unless already changed)
            if ($productPhotos->getProduct() === $this) {
                $productPhotos>setProduct(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
