<?php

namespace App\Tests\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{
    public function setUp(): void

    {
        $this->client = static::createClient();
        $this->userRepository = $this->client->getContainer()->get('doctrine.orm.entity_manager')->getRepository(Users::class);
        $this->user = $this->userRepository->findOneByEmail('mhunmael@hotmail.com');
        $this->urlGenerator = $this->client->getContainer()->get('router.default');
        $this->client->loginUser($this->user);
    }

    public function testListAction()
    {
        $crawler = $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('user_list'));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testCreateAction(): void
    {
        $crawler = $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('user_create'));
        $form = $crawler->selectButton('Ajouter')->form();
        $form['admin_users[username]'] = 'UserAdmintest';
        $form['admin_users[password][first]'] = 'motdepasseuser';
        $form['admin_users[password][second]'] = 'motdepasseuser';
        $form['admin_users[email]'] = 'newuseradmin@gmail.com';
        $form['admin_users[roles]'] = array("0" => '["ROLE_ADMIN"]');
        $this->client->submit($form);
        $this->client->followRedirect();
        $this->assertSelectorTextContains('div.alert.alert-success', 'Superbe');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->user = $this->userRepository->findOneByEmail('maelmhun@gmail.com');
        $this->urlGenerator = $this->client->getContainer()->get('router.default');
        $this->client->loginUser($this->user);
        $crawler = $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('user_create'));
        $form = $crawler->selectButton('Ajouter')->form();
        $form['users[username]'] = 'Usertest';
        $form['users[password][first]'] = 'motdepasseuser';
        $form['users[password][second]'] = 'motdepasseuser';
        $form['users[email]'] = 'newuser@gmail.com';
        $this->client->submit($form);
        $this->client->followRedirect();
        $this->assertSelectorTextContains('div.alert.alert-success', 'Superbe');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
