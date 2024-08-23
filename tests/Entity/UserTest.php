<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testUserSettersAndGetters()
    {
        $user = new User();
        
        $user->setLastname('Durand');
        $this->assertEquals('Durand', $user->getLastname());

        $user->setFirstName('Jean');
        $this->assertEquals('Jean', $user->getFirstName());

        $user->setEmail('jean.durand@example.com');
        $this->assertEquals('jean.durand@example.com', $user->getEmail());
        $this->assertEquals('jean.durand@example.com', $user->getUserIdentifier());

        $user->setPassword('pwd');      
        $this->assertEquals('pwd', $user->getPassword());

        $user->setRoles(['ROLE_USER']);
        $this->assertEquals(['ROLE_USER'], $user->getRoles());
    }
}