<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController{

    /**
     * @Route("/", name="book")
     */
    public function books( BookRepository $bookRepository){

        $books = $bookRepository->findAll();
        return $this->render('books.html.twig', [
            'books'=>$books
        ]);

    }

    /**
     * @Route("/book/{id}", name="livre")
     */
    public function book ( BookRepository $bookRepository, $id ){

        $book = $bookRepository->find($id);
        return $this->render('livre.html.twig', [
            'book'=> $book
        ]);

    }



}