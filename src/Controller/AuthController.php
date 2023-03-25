<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use OpenApi\Annotations\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\ErrorResponse;
use App\Model\IdResponse;
use App\Model\SignupRequest;
use App\Service\AuthService;
use OpenApi\Annotations\RequestBody as AnnotationsRequestBody;

#[Route('/api/v1/auth')]
class AuthController extends AbstractController
{
    public function __construct(
        private AuthService $authService
    ) { }

    #[Route('/signUp', name: 'app_sign_up', methods: 'POST')]
    public function index(#[RequestBody] SignupRequest $request): JsonResponse
    {
        return $this->json($this->authService->signUp($request));
    }
}