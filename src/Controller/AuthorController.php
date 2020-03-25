<?php


namespace App\Controller;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AuthorController extends AbstractController{

    /**
     * @Route("/author", name="authors_list")
     */
    public function authors( AuthorRepository $authorRepository){

        $authors = $authorRepository->findAll();
        return $this->render('authors.html.twig', [
            'authors'=>$authors
        ]);

    }

    /**
     * @Route("/author/show/{id}", name="author_show")
     */
    public function author ( AuthorRepository $authorRepository, $id ){

        $author = $authorRepository->find($id);
        return $this->render('author.html.twig', [
            'author'=>$author
        ]);

    }


    /**
     * @Route("/author/delete/{id}", name="author_delete")
     */
    public function deleteAuthor(AuthorRepository $authorRepository, $id, EntityManagerInterface $entityManager){

        $author = $authorRepository->find($id);
        $entityManager->remove($author);
        $entityManager->flush();

        return new Response('auteur supprimé');
    }

    /**
     * @Route("/author/update/{id}", name="author_update")
     */
    public function updateAuthor(AuthorRepository $authorRepository, $id, EntityManagerInterface $entityManager){
        

        $author = $authorRepository->find($id);
        $author->setTitle('Walking Dead');
        $entityManager->persist($author);
        $entityManager->flush();

        return new Response('auteur mis à jour');

    }

}