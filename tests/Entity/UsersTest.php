<?php

namespace Tests\App\Entity;

use App\Entity\Task;
use App\Entity\TaskTest;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class UserTest extends WebTestCase
{
    public function testCreateUser()
    {
        $password = "motdepasse";
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $userPasswordHasher = $this->getMockBuilder('Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $userPasswordHasher->method('hashPassword')->willReturn($password);
        $users = new Users();
        $task = new Task();
        $users->setEmail("user@email.com");
        $users->setRoles(["ROLE_USER"]);
        $users->setUsername("newuser");
        $users->setPassword($password);
        $users->addTask($task);
        $usersTasks = $users->getTasks();

        $this->assertEquals("user@email.com", $users->getEmail());
        $this->assertEquals(["ROLE_USER"], $users->getRoles());
        $this->assertEquals("newuser", $users->getUsername());
        $this->assertEquals("motdepasse", $users->getPassword());
        $this->assertEquals(null, $users->getSalt());
        $this->assertEquals($users->getUsername(), $users->getUserIdentifier());
        $this->assertEquals($usersTasks, $users->getTasks());

        $users->removeTask($task);

        $this->assertEquals($usersTasks, $users->getTasks());
    }
}
