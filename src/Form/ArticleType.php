<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Author;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('resume')
            ->add('date')
            ->add('submit', SubmitType::class, [
                'label' => 'Sauvegarder',
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'choice_value' => 'id',
                'multiple' => true,
            ])
        ;
    }
   // use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    // use Symfony\Component\Form\AbstractType;
    // use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
