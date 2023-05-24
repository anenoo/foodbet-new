<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\DateTime;

class Category extends Fixture
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $getUser = $this->entityManager(\App\Entity\User::class)->find(1);
        $total = 15;
        $day = 1;
        while ($total){
            $total--;
            $day++;
            $start = new \DateTime('2023-05-24 00:00:00');
            $start->add(new \DateInterval('P'.$day.'D'));
            $finished = $start->add(new \DateInterval('P'.($day+2).'D'));
            $category = new \App\Entity\Category();
            $category->setName('test'.$total);
            $category->setCreatedBy($getUser);
            $category->setCreatedAT('2023-05-24 00:00:00');
            $category->setStartedAt($start);
            $category->setFinishedAt($finished);
            $manager->persist($category);
        }


        $manager->flush();
    }
}
