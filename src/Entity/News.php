<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
class News
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $news_name = null;

    #[ORM\Column(length: 10000)]
    private ?string $news_text = null;

    #[ORM\Column(length: 255)]
    private ?string $news_author = null;

    #[ORM\Column(length: 255)]
    private ?string $news_date = null;

    #[ORM\Column(length: 500)]
    private ?string $news_img = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNewsName(): ?string
    {
        return $this->news_name;
    }

    public function setNewsName(string $news_name): self
    {
        $this->news_name = $news_name;

        return $this;
    }

    public function getNewsText(): ?string
    {
        return $this->news_text;
    }

    public function setNewsText(string $news_text): self
    {
        $this->news_text = $news_text;

        return $this;
    }

    public function getNewsAuthor(): ?string
    {
        return $this->news_author;
    }

    public function setNewsAuthor(string $news_author): self
    {
        $this->news_author = $news_author;

        return $this;
    }

    public function getNewsDate(): ?string
    {
        return $this->news_date;
    }

    public function setNewsDate(string $news_date): self
    {
        $this->news_date = $news_date;

        return $this;
    }

    public function getNewsImg(): ?string
    {
        return $this->news_img;
    }

    public function setNewsImg(string $news_img): self
    {
        $this->news_img = $news_img;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}
