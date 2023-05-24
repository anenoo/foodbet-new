<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class IdeaFixture extends Fixture implements DependentFixtureInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $getUser = $this->entityManager->getRepository(\App\Entity\User::class)->find(rand(1,5));
        $getCategory = $this->entityManager->getRepository(\App\Entity\Category::class)->find(rand(1,15));
        $total = 50;
        while ($total){
            $total--;
            $category = new \App\Entity\Idea();
            $category->setTitle('test'.$total);
            $category->setCategory($getCategory);
            $category->setUser($getUser);
            $category->setStatus(0);
            $manager->persist($category);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixture::class,
        ];
    }
}
