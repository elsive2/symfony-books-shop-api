<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\UserAlreadyExistsException;
use App\Model\IdResponse;
use App\Model\SignupRequest;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private UserRepository $userRepository
    ) { }

    public function signUp(SignupRequest $request)
    {
        if ($this->userRepository->existsByEmail($request->getEmail())) {
            throw new UserAlreadyExistsException();
        }


        $user = (new User)
            ->setEmail($request->getEmail())
            ->setFirstName($request->getFirstName())
            ->setLastName($request->getLastName())
            ->setRoles([User::ROLE_USER]);

        $user->setPassword($this->hasher->hashPassword($user, $request->getPassword()));

        $this->userRepository->save($user, true);

        return new IdResponse($user->getId());
    }
}