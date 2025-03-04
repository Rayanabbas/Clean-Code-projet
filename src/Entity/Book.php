<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Book {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $title;

    #[ORM\Column(type: "string", length: 255)]
    private string $author;

    #[ORM\Column(type: "boolean")]
    private bool $isBorrowed = false;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTime $borrowDate = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTime $returnDate = null;

    #[ORM\Column(type: "string", length: 100)]
    private string $category; // 🔹 Nouvelle colonne pour la catégorie

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function setAuthor(string $author): void {
        $this->author = $author;
    }

    public function isBorrowed(): bool {
        return $this->isBorrowed;
    }

    public function borrowBook(): string {
        if ($this->isBorrowed) {
            return "Le livre est déjà emprunté.";
        }
        $this->isBorrowed = true;
        $this->borrowDate = new \DateTime();
        return "Livre emprunté avec succès.";
    }

    public function returnBook(): string {
        if (!$this->isBorrowed) {
            return "Ce livre n'a pas été emprunté.";
        }
        $this->isBorrowed = false;
        $this->returnDate = new \DateTime();
        return "Livre retourné avec succès.";
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }
}

