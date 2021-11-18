<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
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
     * @ORM\Column(type="ascii_string")
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activity;

    /**
     * @ORM\Column(type="integer")
     */
    private $base_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $disc_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $access_oddment;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $components_comport;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consumable_ware;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $length;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=ProductProperty::class, mappedBy="product")
     */
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageFilemane;
    
    /**
     * @Vich\UploadableField(mapping="banners", fileNameProperty="imageFilemane")
     *
     * @var File
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     * @ORM\OneToMany(targetEntity=ProductPropety::class, mappedBy="product")
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

    public function getActivity(): ?bool
    {
        return $this->activity;
    }

    public function setActivity(bool $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    public function getBasePrice(): ?int
    {
        return $this->base_price;
    }

    public function setBasePrice(int $base_price): self
    {
        $this->base_price = $base_price;

        return $this;
    }

    public function getDiscPrice(): ?int
    {
        return $this->disc_price;
    }

    public function setDiscPrice(?int $disc_price): self
    {
        $this->disc_price = $disc_price;

        return $this;
    }

    public function getAccessOddment(): ?int
    {
        return $this->access_oddment;
    }

    public function setAccessOddment(int $access_oddment): self
    {
        $this->access_oddment = $access_oddment;

        return $this;
    }

    public function getComponentsComport(): ?string
    {
        return $this->components_comport;
    }

    public function setComponentsComport(?string $components_comport): self
    {
        $this->components_comport = $components_comport;

        return $this;
    }

    public function getConsumableWare(): ?string
    {
        return $this->consumable_ware;
    }

    public function setConsumableWare(?string $consumable_ware): self
    {
        $this->consumable_ware = $consumable_ware;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

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
    
        public function getImage(): ?File
    {
        return $this->image;
    }

    public function setImage(?File $image = null): self
    {
        $this->image = $image;
        
        if (null !== $image) {
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getOffer(): ?Offer
    {
        return $this->offer;
    }

    public function setOffer(?Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getImageFilemane(): ?string
    {
        return $this->imageFilemane;
    }

    public function setImageFilemane(string $imageFilemane): self
    {
        $this->imageFilemane = $imageFilemane;

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

    public function addProductProperty(ProductProperty $productProperty): self
    {
        if (!$this->productProperties->contains($productProperty)) {
            $this->productProperties[] = $productProperty;
            $productProperty->setProduct($this);
        }

        return $this;
    }

    public function removeProductProperty(ProductProperty $productProperty): self
    {
        if ($this->productProperties->removeElement($productProperty)) {
            // set the owning side to null (unless already changed)
            if ($productProperty->getProduct() === $this) {
                $productProperty->setProduct(null);
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

    public function addProductPhoto(ProductPhoto $productPhoto): self
    {
        if (!$this->productPhotos->contains($productPhoto)) {
            $this->productPhotos[] = $productPhoto;
            $productPhoto->setProduct($this);
        }

        return $this;
    }

    public function removeProductPhoto(ProductPhoto $productPhoto): self
    {
        if ($this->productPhotos->removeElement($productPhoto)) {
            // set the owning side to null (unless already changed)
            if ($productPhoto->getProduct() === $this) {
                $productPhoto->setProduct(null);
            }
        }

        return $this;
    }
}
