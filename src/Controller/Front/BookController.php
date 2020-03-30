<?php

namespace App\Controller\Front;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("books", name="book_list")
     */
    public function books(BookRepository $bookRepository)
    {

        // récupérer le repository des Books, car c'est la classe Repository
        // qui me permet de sélectionner les livres en bdd
        $books = $bookRepository->findAll();

        //$book = $bookRepository->find(1);

        return $this->render('front/book/books.html.twig', [
            'books' => $books
        ]);

    }

    /**
     * @Route("/book/show/{id}", name="book_show")
     */
    public function book($id, BookRepository $bookRepository)
    {
        $book = $bookRepository->find($id);

        return $this->render('front/book/book.html.twig', [
            'book' => $book
        ]);
    }
}