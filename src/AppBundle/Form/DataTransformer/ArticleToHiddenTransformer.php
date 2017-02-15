<?php
// src/AppBundle/Form/DataTransformer/ArticleToHiddenTransformer.php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ArticleToHiddenTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (article) to a string (name).
     *
     * @param  Article|null $category
     * @return string
     */
    public function transform($article)
    {
        return $article;
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $articleNumber
     * @return Category|null
     * @throws TransformationFailedException if object (category) is not found.
     */
    public function reverseTransform($articleId)
    {
        // no body name? It's optional, so that's ok
        if (!$articleId) {
            return;
        }

        $article = $this->manager
            ->getRepository('AppBundle:Article')
            // query for the body with this name
            ->find($articleId)
        ;

        if (null === $article) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Un astre avec le nom "%s" n\'existe pas',
                $articleName
            ));
        }

        return $article;
    }
}

?>
