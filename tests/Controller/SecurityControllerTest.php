<?php

namespace App\Tests\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginAction(): void
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testLoginCheck(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login_check');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
    public function testLogoutCheck(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/logout');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
    }
}
