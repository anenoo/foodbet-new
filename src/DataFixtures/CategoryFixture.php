<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\DateTime;

class CategoryFixture extends Fixture implements DependentFixtureInterface
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
        $getUser = $this->entityManager->getRepository(\App\Entity\User::class)->find(rand(1,5));
        $total = 15;
        $day = 1;
        $createdAt = new \DateTimeImmutable('2023-05-24 00:00:00');
        while ($total){
            $total--;
            $day++;
            $start = $createdAt;
            $start->add(new \DateInterval('P'.$day.'D'));
            $finished = $start->add(new \DateInterval('P'.($day+2).'D'));
            $category = new \App\Entity\Category();
            $category->setName('test'.$total);
            $category->setCreatedBy($getUser);
            $category->setCreatedAT($createdAt);
            $category->setStartedAt($start);
            $category->setFinishedAt($finished);
            $manager->persist($category);
        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}
