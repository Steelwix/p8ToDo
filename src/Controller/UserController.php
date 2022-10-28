<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\AdminUsersType;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    #[Route(path: '/users', name: 'user_list')]
    public function listAction(UsersRepository $usersRepository): Response
    {
        return $this->render('user/list.html.twig', ['users' => $usersRepository->findAll()]);
    }

    #[Route(path: '/users/create', name: 'user_create')]
    public function createAction(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManagerInterface): Response
    {
        $users = new Users;
        $user = $this->getUser();
        $userRole = $user->getRoles();
        if ($userRole = array(["ROLE_ADMIN"], "ROLE_USER")) {
            $form = $this->createForm(AdminUsersType::class, $users);
        } else {
            $form = $this->createForm(UsersType::class, $users);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $userPasswordHasher->hashPassword($users, $users->getPassword());
            $user->setPassword($password);
            $user->setRoles($form->get('roles')->getData());
            $entityManagerInterface->persist($users);
            $entityManagerInterface->flush();

            $this->addFlash('success', "L'utilisateur a bien été ajouté.");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/users/{id}/edit', name: 'user_edit')]
    public function editAction(Users $user, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManagerInterface): Response
    {
        $form = $this->createForm(UsersType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $userPasswordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }
}
