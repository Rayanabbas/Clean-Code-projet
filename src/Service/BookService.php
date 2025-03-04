<?php

namespace App\Service;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;

class BookService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function borrowBook(Book $book): string
    {
        if ($book->isBorrowed()) {
            return "Le livre est déjà emprunté.";
        }

        $book->setIsBorrowed(true);
        $book->setBorrowDate(new \DateTime());

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return "Livre emprunté avec succès.";
    }

    public function returnBook(Book $book): string
    {
        if (!$book->isBorrowed()) {
            return "Ce livre n'a pas été emprunté.";
        }

        $book->setIsBorrowed(false);
        $book->setReturnDate(new \DateTime());

        $this->entityManager->persist($book);
        $this->entityManager->flush();

        return "Livre retourné avec succès.";
    }
}
