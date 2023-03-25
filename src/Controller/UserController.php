<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

#[Route('/api/v1')]
class UserController extends AbstractController
{
    #[Route('/user/me', name: 'app_user')]
    public function userAction(#[CurrentUser] UserInterface $user): JsonResponse
    {
        return $this->json($user);
    }
}
