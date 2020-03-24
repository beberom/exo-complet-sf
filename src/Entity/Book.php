<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="string")
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPages;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function getResume()
    {
        return $this->resume;
    }

    public function setResume($resume): void
    {
        $this->resume = $resume;
    }


    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }


    public function getNbPages()
    {
        return $this->nbPages;
    }

    public function setNbPages($nbPages): void
    {
        $this->nbPages = $nbPages;
    }
}
