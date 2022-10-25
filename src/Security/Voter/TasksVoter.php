<?php

namespace App\Security\Voter;

use App\Entity\Task;
use App\Entity\Users;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TasksVoter extends Voter
{
    public const ANO_TASK = 'anoTask';

    protected function supports(string $attribute, $task): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::ANO_TASK])
            && $task instanceof Task;
    }

    protected function voteOnAttribute(string $attribute, $task, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::ANO_TASK:
                // logic to determine if the user can EDIT
                return $this->CanSeeAnonymousTasks($task, $user);
                break;
        }

        return false;
    }

    private function CanSeeAnonymousTasks(Task $task, Users $user)
    {
        $roles = $user->getRoles();
        return $roles === ["ROLE_ADMIN"];
    }
}
