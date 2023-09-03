<?php

namespace App\DataFixtures;

use App\Entity\Banana;
use App\Entity\Coconut;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $i = 0;
        while ($i <= 100000) {
            $user = new User();
            $manager->persist($user);
            $coconut = new Coconut();
            $coconut->setUsers($user);
            $coconut->setValue(1);
            $manager->persist($coconut);
            $banana = new Banana();
            $banana->setUsers($user);
            $banana->setValue(1);
            $manager->persist($banana);
            $i++;
        }
        $manager->flush();
    }
}
