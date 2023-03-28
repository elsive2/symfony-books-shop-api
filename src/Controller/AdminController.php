<?php

namespace App\Controller;

use App\Model\ErrorResponse;
use App\Service\RoleService;
use OpenApi\Annotations\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;

#[Route('/api/v1/admin', name: 'app_admin')]
class AdminController extends AbstractController
{
    public function __construct(
        private RoleService $roleService
    ) { }

    /**
     * @Response(
     *  response=200,
     *  description="Grants ROLE_AUTHOR to a user"
     * )
     * @Response(
     *  response=404,
     *  description="User not found",
     *  @Model(type=ErrorResponse::class)
     * )
     */
    #[Route('/grantAuthor/{userId}', name: 'app_admin_grant_author_user', methods: ['POST'])]
    public function grantAuthorAction(int $userId): JsonResponse
    {
        $this->roleService->grantAuthor($userId);

        return $this->json(['message' => 'success']);
    }
}
