<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase
{
    private $client;
    private  $entityManager;

    protected function setUp(): void
    {   
        $this->client = static::createClient();

        // $kernel = self::bootKernel();

        $this->entityManager = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $userRepository = $this->entityManager->getRepository(User::class);
        $testUser = $userRepository->findOneBy(["email"=>'test@gmail.com']); 
        if ($testUser) {
            $this->entityManager->remove($testUser);
            $this->entityManager->flush();
        }

        $this->client = null;
        $this->entityManager->close();
        $this->entityManager = null; 
    }

    public function testRenderRegisterPage()
    {
        $crawler = $this->client->request('GET', '/register');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');
    }

    public function testSuccessfulRegister()
    {
        $crawler = $this->client->request('GET', '/register');
        $form = $crawler->selectButton('Register')->form([
            'registration_form[firstname]' => 'Lilian',
            'registration_form[lastname]' => 'Arnaudies',
            'registration_form[email]' => 'test@gmail.com',
            'registration_form[plainPassword]' => '123456',
        ]);
        $this->client->submit($form);

        $this->assertResponseRedirects('/login');

        $crawler = $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue');

        $userRepository = $this->entityManager->getRepository(User::class);
        $createdUser = $userRepository->findOneBy(["email"=>'test@gmail.com']);
        $this->assertNotNull($createdUser);
        $this->assertEquals('Lilian', $createdUser->getFirstname());
    }
}
