<?php
// src/AppBundle/Form/DataTransformer/CategoryToNameTransformer.php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Body;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CategoryToNameTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (category) to a string (name).
     *
     * @param  Category|null $category
     * @return string
     */
    public function transform($category)
    {
        if (null === $category) {
            return '';
        }

        return $category->getName();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $categoryNumber
     * @return Category|null
     * @throws TransformationFailedException if object (category) is not found.
     */
    public function reverseTransform($categoryName)
    {
        // no body name? It's optional, so that's ok
        if (!$categoryName) {
            return;
        }

        $category = $this->manager
            ->getRepository('AppBundle:Category')
            // query for the body with this name
            ->findOneByName($categoryName)
        ;

        if (null === $category) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Un astre avec le nom "%s" n\'existe pas',
                $categoryName
            ));
        }

        return $category;
    }
}

?>
