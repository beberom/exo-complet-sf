<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    // je créé une méthode pour selectionner des livres en fonction
    // d'un mot contenu dans le résumé
    public function getByWordInResume()
    {

        // je défini le mot à rechercher dans la colonne resume
        $word = 'japon';

        // je récupère le "query builder" qui me permet de créer mes requetes
        // SELECT en base de données
        // je passe en parametre de la méthode createQueryBuilder une lettre ou un mot
        // qui fera office d'alias pour ma table
        $queryBuilder = $this->createQueryBuilder('book');

        // je fais mon select dans la table "book"
        $query = $queryBuilder->select('book')
            // je définie une clause "where" avec un like dans la colonne "resume"
            ->where('book.resume LIKE :word')
            // j'utilise setParameter pour que la variable de recherche soit sécurisée
            ->setParameter('word', '%'.$word.'%')
            // je récupère la requete générée par le query builder
            ->getQuery();

        // j'execute la requete et je récupère les résultats
        $results = $query->getResult();

        // je returne les résultats
        return $results;
    }

}