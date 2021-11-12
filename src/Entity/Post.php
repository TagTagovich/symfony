<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
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
    
    /**
     * 
     * @Assert\NotBlank
     * @Assert\Type("string") 
     * 
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    
    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    
    /**
     * 
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $created_at;

    /**
     * @ORM\Column(type="date_immutable")
     */
    
    /**
     * 
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getUpdatedUp(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedUp(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    /*
    public function isPasswordSafe()
    {
    
    // some code
    
    }
    */
}
