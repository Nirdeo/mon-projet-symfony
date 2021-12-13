<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 21; $i++) {

            // Création d'un timestamp aléatoire (de 1970 à la date courante)
            $timestamp = mt_rand(1, time());
            $date = new \DateTime();
            $date->setTimestamp($timestamp);

            $article = new Article();
            $article
                ->setTitle('Article -'.$i)
                ->setContent('lorem ipsum ...')
                ->setResume('Résumé de mon article')
                ->setAuthor($this->getReference('author-'.rand(1, 5)))
                ->setDate($date);

            $countCategories = rand(0, 10);
            if ($countCategories > 0) {
                for ($j = 1; $j < $countCategories; $j++) {
                    $article->addCategory($this->getReference('category-'.$j));
                }
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
