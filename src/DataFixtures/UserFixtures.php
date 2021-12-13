<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) : void
    {
        $user1 = new User();
        $password = $this->encoder->encodePassword($user1, 'pass_1234');
        $user1
            ->setEmail('test@example.com')
            ->setPassword($password)
            ->setRoles(['ROLE_USER']);
        $manager->persist($user1);
        $manager->flush();

        $user2 = new User();
        $password = $this->encoder->encodePassword($user2, 'pass_1234');
        $user2
            ->setEmail('test@example.com')
            ->setPassword($password)
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);
        $manager->flush();
    }
}
