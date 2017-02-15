<?php
// src/AppBundle/Twig/AppExtension.php
namespace AppBundle\Twig;

use Doctrine\ORM\PersistentCollection;
use Doctrine\Common\Collections\ArrayCollection;

class AppExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }
    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return Twig_SimpleFunction[]
     */
    function getFunctions()
    {
      return array(
        new \Twig_SimpleFunction('getCountComment', array($this,'getCountComment')),
      );
    }

    /**
     * @var publicityRepository
     */
    protected $em;

    public function __construct($em)
    {
      $this->em = $em;
    }

    public function getCountComment($article_id){
        return $this->em
                    ->getRepository('AppBundle:Comment')
                    ->getCommentCount($article_id);
    }
    public function getName()
    {
        return 'app_extension';
    }
}
?>
