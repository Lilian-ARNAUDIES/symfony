<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User(); 
        $user1->setFirstname('Lilian');
        $user1->setLastname('Arnaudies');
        $user1->setPassword('123456');
        $user1->setRoles(['ROLE_USER']);
        $user1->setEmail('test@gmail.om');

        $user2 = new User(); 
        $user2->setFirstname('Jean');
        $user2->setLastname('Arnaudies');
        $user2->setPassword('123456');
        $user2->setRoles(['ROLE_USER']);
        $user2->setEmail('test2@gmail.om');
        
        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();
    }
}
