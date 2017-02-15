<?php
// src/AppBundle/EventListener/ArticleListener.php
namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Article;

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
      if (!$entity instanceof Article){
        return;
      }
      $entity->setDate(new \DateTime());
      $entity->setAuthor($this->context->getToken()->getUser()->getUsername());

    }

}
 ?>
