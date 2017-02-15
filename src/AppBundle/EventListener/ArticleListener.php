<?php
// src/AppBundle/EventListener/ArticleListener.php
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;

class ArticleListener
{
    private $context;
    public function __construct($context){
      $this->context = $context;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->setDateAndAuthor($args->getEntity());
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->setDateAndAuthor($args->getEntity());
    }

    public function setDateAndAuthor($entity){
      if (!$entity instanceof Article && !$entity instanceof Comment ){
        return;
      }
      $entity->setDate(new \DateTime());
      if (!$entity->getAuthor())
        $entity->setAuthor($this->context->getToken()->getUser()->getUsername());

    }

}
 ?>
