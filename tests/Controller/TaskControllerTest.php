<?php

namespace Tests\App\Controller;

use App\Entity\Task;
use App\Entity\TaskTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class TaskControllerTest extends WebTestCase
{
    public function testcreateAction()
    {
        $task = new TaskTest('Titre', 'Contenu');
        $this->assertSame(1.0, $task->computeTask());
    }
}
