<?php

namespace App\Tests\DataFixtures;

use App\Entity\Task;
use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixturesTest extends WebTestCase
{
    private MockObject | UserPasswordHasherInterface | null $userPasswordHasher;
    private MockObject | ObjectManager | null $manager;
    public function setUp(): void
    {

        $password = "motdepasse";
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $userPasswordHasher = $this->getMockBuilder('Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $manager = $this->getMockBuilder('Doctrine\Persistence\ObjectManager')
            ->disableOriginalConstructor()
            ->getMock();
        $manager->method('persist')->willReturn(1);
        $userPasswordHasher->method('hashPassword')->willReturn($password);
    }
    public function testLoad(): void
    {

        $password = "motdepasse";
        $users = new Users();
        $task = new Task();
        $users->setEmail("mhunmael@hotmail.com");
        $users->setRoles(array("0" => "ROLE_ADMIN", "1" => "ROLE_USER"));
        $users->setUsername("Steelwix");
        $users->setPassword($password);
        $users->addTask($task);

        $this->assertEquals("mhunmael@hotmail.com", $users->getEmail());
        $this->assertEquals(array("0" => "ROLE_ADMIN", "1" => "ROLE_USER"), $users->getRoles());
        $this->assertEquals("Steelwix", $users->getUsername());
        $this->assertEquals("motdepasse", $users->getPassword());
        $this->assertEquals(null, $users->getSalt());
        $this->assertEquals($users->getUsername(), $users->getUserIdentifier());


        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $users = new Users();
        $task = new Task();
        $task->setTitle("Title");
        $task->setContent("Content");
        $task->setUsers($users);
        $task->setCreatedAt($dateImmutable);

        $this->assertEquals("Title", $task->getTitle());
        $this->assertEquals("Content", $task->getContent());
        $this->assertEquals($users, $task->getUsers());
        $this->assertEquals($dateImmutable, $task->getCreatedAt());
    }
}
