<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $answer4 = null;

    #[ORM\Column]
    private ?bool $visible = null;

    

    

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

    public function getAnswer1(): ?string
    {
        return $this->answer1;
    }

    public function setAnswer1(?string $answer1): self
    {
        $this->answer1 = $answer1;

        return $this;
    }

    public function getAnswer2(): ?string
    {
        return $this->answer2;
    }

    public function setAnswer2(?string $answer2): self
    {
        $this->answer2 = $answer2;

        return $this;
    }

    public function getAnswer3(): ?string
    {
        return $this->answer3;
    }

    public function setAnswer3(?string $answer3): self
    {
        $this->answer3 = $answer3;

        return $this;
    }

    public function getAnswer4(): ?string
    {
        return $this->answer4;
    }

    public function setAnswer4(?string $answer4): self
    {
        $this->answer4 = $answer4;

        return $this;
    }

    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    
}
