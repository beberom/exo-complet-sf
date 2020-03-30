<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    /**
     * @Route("admin/authors", name="admin_author_list")
     */
    public function authors(AuthorRepository $authorRepository)
    {
        $authors = $authorRepository->findAll();

        return $this->render('admin/author/authors.html.twig', [
            'authors' => $authors
        ]);
    }


    /**
     * @Route("admin/author/show/{id}", name="admin_author_show")
     */
    public function author(AuthorRepository $authorRepository, $id)
    {
        $author = $authorRepository->find($id);

        return $this->render('admin/author/author.html.twig', [
            'author' => $author
        ]);
    }

    /**
     * @Route("admin/author/insert", name="admin_author_insert")
     */
    public function authorInsert(EntityManagerInterface $entityManager)
    {
        $author = new Author();

        $author->setFirstName("Bernard");
        $author->setName("Werber");
        $author->setBiography("Les fourmis blablab");
        $author->setBirthDate(new \DateTime('1879-03-14'));

        $entityManager->persist($author);

        $entityManager->flush();

        return $this->render('admin/author/insert.html.twig', [
            'author' => $author
        ]);
    }

    /**
     * @Route("admin/author/delete/{id}", name="admin_author_delete")
     */
    public function authorDelete(
        AuthorRepository $authorRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
        $author = $authorRepository->find($id);

        $entityManager->remove($author);
        $entityManager->flush();

        return $this->render('admin/author/delete.html.twig', [
            'author' => $author
        ]);
    }

    /**
     * @Route("admin/author/update/{id}", name="admin_author_update")
     */
    public function updateAuthor(
        AuthorRepository $authorRepository,
        EntityManagerInterface $entityManager,
        $id
    )
    {
        $author = $authorRepository->find($id);

        $author->setFirstName('newFirstName');

        $entityManager->persist($author);

        $entityManager->flush();

        return $this->render('admin/author/update.html.twig', [
            'author' => $author
        ]);
    }

}
