<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    #[Route('/borrow/{id}', name: 'borrow_book', methods: ['POST'])]
    public function borrowBook(int $id, BookRepository $bookRepository): JsonResponse
    {
        $book = $bookRepository->find($id);
        if (!$book) {
            return $this->json(['message' => 'Livre introuvable'], Response::HTTP_NOT_FOUND);
        }

        $message = $this->bookService->borrowBook($book);
        return $this->json(['message' => $message]);
    }

    #[Route('/return/{id}', name: 'return_book', methods: ['POST'])]
    public function returnBook(int $id, BookRepository $bookRepository): JsonResponse
    {
        $book = $bookRepository->find($id);
        if (!$book) {
            return $this->json(['message' => 'Livre introuvable'], Response::HTTP_NOT_FOUND);
        }

        $message = $this->bookService->returnBook($book);
        return $this->json(['message' => $message]);
    }
}

