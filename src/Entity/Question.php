<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
	public static function loadValidatorMetadata(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('rightAnswer', new Assert\Range([
			'min' => 1,
			'max' => 4,
			'notInRangeMessage' => 'La valeur doit être entre {{ min }} et {{ max }}.',
		]));
	}
	public static function test(ClassMetadata $metadata)
	{
		$metadata->addPropertyConstraint('answers', new Assert\Range([
			'min' => 1,
			'max' => 4,
			'notInRangeMessage' => 'La valeur doit être entre {{ min }} et {{ max }}.',
		]));
	}
	
	
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    

    #[ORM\Column]
    private ?bool $visible = null;

    #[ORM\Column(nullable: true)]
    private ?int $rightAnswer = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private array $answers = [];
		
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


    public function isVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getRightAnswer(): ?int
    {
        return $this->rightAnswer;
    }

    public function setRightAnswer(?int $rightAnswer): self
    {
        $this->rightAnswer = $rightAnswer;

        return $this;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(?array $answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    

    

    
}
