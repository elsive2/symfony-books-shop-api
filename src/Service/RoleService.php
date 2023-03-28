<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class RoleService
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $em
    ) { }

    public function grantAdmin(int $userId)
    {
        $this->grantRole($userId, User::ROLE_ADMIN);
    }

    public function grantAuthor(int $userId)
    {
        $this->grantRole($userId, User::ROLE_AUTHOR);
    }

    protected function grantRole(int $userId, string $role)
    {
        /** @var User $user */
        $user = $this->userRepository->getUser($userId);
        $user->setRoles([$role]);

        $this->em->flush();
    }
}