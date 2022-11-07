<?php

namespace App\Tests\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends WebTestCase
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
        $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('task_list'));

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->user = $this->userRepository->findOneByEmail('maelmhun@gmail.com');
        $this->urlGenerator = $this->client->getContainer()->get('router.default');
        $this->client->loginUser($this->user);

        $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('task_list'));
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    public function testCreateAction()
    {

        $crawler = $this->client->request(Request::METHOD_GET, $this->urlGenerator->generate('task_create'));
        $form = $crawler->selectButton('Ajouter')->form();
        $form['task[title]'] = 'Titre de test';
        $form['task[content]'] = 'Contenu de test';
        $this->client->submit($form);
        $this->client->followRedirect();

        $this->assertSelectorTextContains('div.alert.alert-success', 'Superbe');
    }
}
