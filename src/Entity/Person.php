<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sex;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sex", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sex2;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="father")
     * @ORM\JoinColumn(nullable=true)
     */
    private $father;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="mother")
     * @ORM\JoinColumn(nullable=true)
     */
    private $mother;

    public function __construct()
    {
        $this->father = new ArrayCollection();
        $this->mother = new ArrayCollection();
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

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSex2(): ?Sex
    {
        return $this->sex2;
    }

    public function setSex2(?Sex $sex2): self
    {
        $this->sex2 = $sex2;

        return $this;
    }

    public function getFather(): ?self
    {
        return $this->father;
    }

    public function setFather(?self $father): self
    {
        $this->father = $father;

        return $this;
    }

    public function addFather(self $father): self
    {
        if (!$this->father->contains($father)) {
            $this->father[] = $father;
            $father->setFather($this);
        }

        return $this;
    }

    public function removeFather(self $father): self
    {
        if ($this->father->contains($father)) {
            $this->father->removeElement($father);
            // set the owning side to null (unless already changed)
            if ($father->getFather() === $this) {
                $father->setFather(null);
            }
        }

        return $this;
    }

    public function getMother(): ?self
    {
        return $this->mother;
    }

    public function setMother(?self $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

    public function addMother(self $mother): self
    {
        if (!$this->mother->contains($mother)) {
            $this->mother[] = $mother;
            $mother->setMother($this);
        }

        return $this;
    }

    public function removeMother(self $mother): self
    {
        if ($this->mother->contains($mother)) {
            $this->mother->removeElement($mother);
            // set the owning side to null (unless already changed)
            if ($mother->getMother() === $this) {
                $mother->setMother(null);
            }
        }

        return $this;
    }
}
