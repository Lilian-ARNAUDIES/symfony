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
        $this->assertSelectorTextContains('h1', 'Login');
    }

    public function testSuccessfulLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form([
            '_email' => 'user@example.com',
            '_password' => 'correctpassword',
        ]);
        $this->client->submit($form);

        $this->assertResponseRedirects('/home');  
        
        $crawler = $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Home'); 
    }

    public function testWrongLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form([
            '_email' => 'user@example.com',
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
