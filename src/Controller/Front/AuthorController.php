<?php

namespace App\Controller\Front;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("authors", name="author_list")
     */
    public function authors(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findAll();

        return $this->render('front/author/authors.html.twig', [
            'authors' => $authors
        ]);
    }


    /**
     * @Route("author/show/{id}", name="author_show")
     */
    public function author(AuthorRepository $authorRepository, $id)
    {
        $author = $authorRepository->find($id);

        return $this->render('front/author/author.html.twig', [
            'author' => $author
        ]);
    }
}