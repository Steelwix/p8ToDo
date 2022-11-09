<?php

namespace App\Tests\Security;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuthentificatorAuthenticatorTest extends WebTestCase
{
    public function setUp(): void

    {
        $this->client = static::createClient();
        $this->userRepository = $this->client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Users::class);
        $this->user = $this->userRepository->findOneByEmail('mhunmael@hotmail.com');
        $this->urlGenerator = $this->client->getContainer()->get('router.default');
        $this->client->loginUser($this->user);
    }
    public function testAuthenticate(): void
    {
        $crawler = $this->client->request(Request::METHOD_GET, 'username');
    }
}
