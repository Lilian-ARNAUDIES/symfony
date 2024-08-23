<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testLoginPageIsRender()
    {
        $crawler = $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please');
    }

    public function testSuccessfulLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'email1@mail.com',
            '_password' => 'azerty',
        ]);
        $this->client->submit($form);

        $this->assertResponseRedirects('/');  
        
        $crawler = $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue'); 
    }

    public function testWrongLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'user@example.com',
            '_password' => 'wrongpassword',
        ]);
        $this->client->submit($form);

        $this->assertResponseRedirects('/login');

        $crawler = $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('.alert-danger'); 
    }

    protected function tearDown(): void
    {
        $this->client = null;
        parent::tearDown();
    }
}
