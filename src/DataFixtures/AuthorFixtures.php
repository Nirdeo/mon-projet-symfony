<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 6; $i++) {
            $author = new Author();
            $author
                ->setFirstName('Auteur-'.$i)
                ->setLastName('Nom-'.$i);

            $this->addReference('author-'.$i, $author);
            $manager->persist($author);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
