<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\DataTransformer\CategoryToNameTransformer;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('content')
                ->add('category', EntityType::class, [
                  'class' => 'AppBundle:Category',
                  'choice_label' => 'name'
                ])
                ->add('tags', EntityType::class, [
                  'class' => 'AppBundle:Tag',
                  'choice_label' => 'name',
                  'multiple'     => true
                ])
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
