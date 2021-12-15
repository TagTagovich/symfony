<?php

namespace App\Entity;

use App\Repository\ImportFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 *
 * @ORM\Entity(repositoryClass=ImportFileRepository::class)
 */
class ImportFile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @ORM\Column(type="string")
     */
    private $excelFilename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExcelFilename(): ?string
    {
        return $this->excelFilename;
    }

    public function setExcelFilename(?string $excelFilename): self
    {
        $this->excelFilename = $excelFilename;

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
}
