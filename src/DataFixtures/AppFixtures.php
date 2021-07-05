<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $event = new Event();

        $event->setName("Premier Event")
            ->setTitle("Evenement de test")
            ->setDescription("Ceci est un évenement de test")
            ->setLink("http://github.com")
            ->setDisplay(1);
            
        $manager->persist($event);

        $manager->flush();
    }
}
