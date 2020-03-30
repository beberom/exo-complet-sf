<?php

namespace App\Controller\Front;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(BookRepository $bookRepository)
    {

        // METHODE 1 (pas optimisée)
        // je récupére uniquement les deux derniers éléments de mon array de books
        // donc les deux derniers livres
        //$books = $bookRepository->findAll();
        //$lastBooks = array_slice($books, -2, 2);

        //METHODE 2
        $lastBooks = $bookRepository->findBy([], ['id' => 'DESC'], 2, 0);

        return $this->render( 'front/home.html.twig', [
            'books' => $lastBooks
        ]);
    }
}