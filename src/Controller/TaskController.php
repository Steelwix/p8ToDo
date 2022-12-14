<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{
    #[Route(path: '/tasks', name: 'task_list')]
    public function listAction(TaskRepository $taskRepository): Response
    {
        $users = $this->getUser();
        $usersRole = $users->getRoles();
        if ($usersRole == ["ROLE_USER"]) {
            return $this->render('task/list.html.twig', ['tasks' => $taskRepository->findByUsers($users), 'anoTasks' => null]);
        }
        return $this->render('task/list.html.twig', ['tasks' => $taskRepository->findByUsers($users), 'anoTasks' => $taskRepository->findByUsers(null)]);
    }

    #[Route(path: '/tasks/create', name: 'task_create')]
    public function createAction(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $user = $this->getUser();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUsers($user);
            $entityManagerInterface->persist($task);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/tasks/{id}/edit', name: 'task_edit')]
    public function editAction(Task $task, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $user = $this->getUser();
        $usersRole = $user->getRoles();
        if ($usersRole == ["ROLE_USER"]) {
            $usersTask = $task->getUsers();
            if ($usersTask !== $this->getUser()) {
                return $this->redirectToRoute('task_list');
            }
        }
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($task);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }

    #[Route(path: '/tasks/{id}/toggle', name: 'task_toggle')]
    public function toggleTaskAction(Task $task,  EntityManagerInterface $entityManagerInterface): Response
    {
        $user = $this->getUser();
        $usersRole = $user->getRoles();
        if ($usersRole == ["ROLE_USER"]) {
            $usersTask = $task->getUsers();
            if ($usersTask !== $this->getUser()) {
                return $this->redirectToRoute('task_list');
            }
        }
        $task->toggle(!$task->isDone());
        $entityManagerInterface->persist($task);
        $entityManagerInterface->flush();

        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

        return $this->redirectToRoute('task_list');
    }

    #[Route(path: '/tasks/{id}/delete', name: 'task_delete')]
    public function deleteTaskAction(Task $task, EntityManagerInterface $entityManagerInterface): Response
    {
        $user = $this->getUser();
        $usersRole = $user->getRoles();
        if ($usersRole == ["ROLE_USER"]) {
            $usersTask = $task->getUsers();
            if ($usersTask !== $this->getUser()) {
                return $this->redirectToRoute('task_list');
            }
        }
        $entityManagerInterface->remove($task);
        $entityManagerInterface->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('task_list');
    }
}
