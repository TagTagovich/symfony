<?php

namespace App\Entity;

use App\Repository\ProductPhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass=ProductPhotoRepository::class)
 */
class ProductPhoto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
     private $updatedAt;

    /**
     * @ORM\Column(type="string", length=500 )
     */
     private $imageName;
    
    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     * 
     * @var File
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testField;
    
    public $product;

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

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    
    public function getTestField(): ?string
    {
        return $this->testField;
    }

    public function setTestField(string $testField): self
    {
        $this->testField = $testField;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;

        return $this;
    }
}
