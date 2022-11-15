<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Config\Definition\Exception\Exception;

class TaskTest extends WebTestCase
{

    public function testCreateAction()
    {

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
