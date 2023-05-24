<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{ 
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++){
            $user = new \App\Entity\User();
            $user->setEmail('admin'.$i.'@test.com');

            $password = $this->hasher->hashPassword($user, '1234');
            $user->setPassword($password);
            $user->setTotalCoins(0);

            $manager->persist($user);
        }
        
        $manager->flush();
    }
}
