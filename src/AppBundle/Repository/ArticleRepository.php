<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{

  public function findLast($nb = 10){
    return $this->createQueryBuilder('a')
                ->OrderBy('a.date','DESC')
                ->setMaxResults($nb)
                ->getQuery()
                ->getResult()
                ;
  }
  public function getPage($page = 1, $nb = 2, $query){
    $qB = $this->createQueryBuilder('a')
                        ->select('a')
                        ->setMaxResults($nb)
                        ->leftJoin('a.tags', 't')
                        ->setFirstResult($nb * ($page - 1));
    if (!empty(array_filter($query))){
      if ($name = $query['name']){
        $qB->Where("a.name LIKE :name")
           ->setParameter('name', "%{$name}%")
           ;
      }
      if ($tag = $query['tag']){
        $qB->andWhere("t.name LIKE :tag")
           ->setParameter('tag', "%{$tag}%")
           ;
      }
    }

    $page = new Paginator($qB);
    return $page;


  }

}
