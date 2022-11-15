<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $users = new Users();
        $users->setUsername("Steelwix");
        $users->setEmail("mhunmael@hotmail.com");
        $users->setRoles(["ROLE_ADMIN"]);
        $users->setPassword($this->userPasswordHasher->hashPassword($users, "motdepasse"));
        $manager->persist($users);
        $listUsers[] = $users;

        $users = new Users();
        $users->setUsername("Mael");
        $users->setEmail("maelmhun@gmail.com");
        $users->setRoles(["ROLE_USER"]);
        $users->setPassword($this->userPasswordHasher->hashPassword($users, "motdepasse"));
        $manager->persist($users);
        $listUsers[] = $users;

        $task = new Task();
        $task->setTitle("Tache ano");
        $task->setContent("ertjyk");
        $task->setUsers(null);
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $task->setCreatedAt($dateImmutable);
        $manager->persist($task);

        $task = new Task();
        $task->setTitle("Tache 1");
        $task->setContent("contenu");
        $task->setUsers($listUsers[array_rand($listUsers)]);
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $task->setCreatedAt($dateImmutable);
        $manager->persist($task);

        $task = new Task();
        $task->setTitle("Tache 2");
        $task->setContent("contenu");
        $task->setUsers($listUsers[array_rand($listUsers)]);
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $task->setCreatedAt($dateImmutable);
        $manager->persist($task);

        $task = new Task();
        $task->setTitle("Tache 3");
        $task->setContent("contenu");
        $task->setUsers($listUsers[array_rand($listUsers)]);
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $task->setCreatedAt($dateImmutable);
        $manager->persist($task);

        $task = new Task();
        $task->setTitle("Tache 4");
        $task->setContent("contenu");
        $task->setUsers($listUsers[array_rand($listUsers)]);
        $dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $task->setCreatedAt($dateImmutable);
        $manager->persist($task);

        $manager->flush();
    }
}
