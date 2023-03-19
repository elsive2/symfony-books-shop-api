<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Request\SubscriberRequest;
use App\Service\SubscriberService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1')]
class SubscribeController extends AbstractController
{
    public function __construct(
        private SubscriberService $subscriberService
    ) { }

    #[Route('/subscribe', name: 'app_subscribe', methods: ['POST'])]
    public function index(#[RequestBody] SubscriberRequest $request): Response
    {
        return $this->json($this->subscriberService->subscribe($request));
    }
}
