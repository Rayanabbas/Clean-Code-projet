<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "array")]
    private array $borrowedBooks = [];

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getBorrowedBooks(): array {
        return $this->borrowedBooks;
    }

    public function borrowBook(Book $book): string {
        if (count($this->borrowedBooks) >= 3) {
            return "Vous avez atteint la limite d'emprunts.";
        }

        if ($book->isBorrowed()) {
            return "Ce livre est déjà emprunté.";
        }

        $book->borrowBook();
        $this->borrowedBooks[] = $book->getId();
        return "Livre emprunté avec succès.";
    }

    public function returnBook(Book $book): string {
        if (!in_array($book->getId(), $this->borrowedBooks)) {
            return "Ce livre n'est pas dans votre liste d'emprunts.";
        }

        $book->returnBook();
        $this->borrowedBooks = array_filter($this->borrowedBooks, fn($id) => $id !== $book->getId());
        return "Livre retourné avec succès.";
    }
}
