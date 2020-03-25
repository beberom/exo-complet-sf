<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController{

    /**
     * @Route("/", name="books_list")
     */
    public function books( BookRepository $bookRepository){

        $books = $bookRepository->findAll();
        return $this->render('books.html.twig', [
            'books'=>$books
        ]);

    }

    /**
     * @Route("/book/show/{id}", name="book_show")
     */
    public function book ( BookRepository $bookRepository, $id ){

        $book = $bookRepository->find($id);
        return $this->render('livre.html.twig', [
            'book'=> $book
        ]);

    }

    /**
     * @Route("/book/insert", name="book_insert")
     */
    public function insertBook(EntityManagerInterface $entityManager)
    {

        $book = new Book();

        $book->setTitle('Game Of Thrones');
        $book->setAuthor('Minussss');
        $book->setNbPages(200);
        $book->setResume('Neuf familles nobles rivalisent pour le contrôle du Trône de Fer dans les sept royaumes de Westeros. Pendant ce temps, des anciennes créatures mythiques oubliées reviennent pour faire des ravages.');

        $entityManager->persist($book);

        $entityManager->flush();

        return new Response('livre enregistré');

    }

    /**
     * @Route("/book/delete/{id}", name="book_delete")
     */
    public function deletebook(BookRepository $bookRepository, $id, EntityManagerInterface $entityManager){

        $book = $bookRepository->find($id);
        $entityManager->remove($book);
        $entityManager->flush();
        return $this->render('delete.html.twig', [
            'book'=>$book
        ]);
    }

    /**
     * @Route("/book/update/{id}", name="book_update")
     */
    public function updatebook(BookRepository $bookRepository, $id, EntityManagerInterface $entityManager){




        $book = $bookRepository->find($id);
        $book->setTitle('Walking Dead');
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->render('update.html.twig', [
            'book'=>$book
        ]);

    }

    /**
     * @Route("/book/search", name="book_search")
     */
    public function searchByResume(BookRepository $bookRepository, Request $request)
    {
        $search = $request->query->get('search');
        $books = $bookRepository->getByWordInResume($search);

        return $this->render('books.html.twig', [
            'books'=> $books
        ]);
    }
}