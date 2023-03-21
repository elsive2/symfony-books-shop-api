<?php

namespace App\Controller;

use App\Model\ReviewPage;
use App\Service\ReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\Schema;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/v1')]
class ReviewController extends AbstractController
{
    public function __construct(
        private ReviewService $reviewService
    ) { }

    /**
     * @Parameter(name="page", in="query", description="Page number", @Schema(type="integer"))
     * @Response(
     *  response=200,
     *  description="Get reviews by book id",
     *  @Model(type=ReviewPage::class)
     * )
     * @Response(
     *  response=404,
     *  description="Book not found",
     *  @Model(type=ErrorResponse::class)
     * )
     */
    #[Route('/book/{id}/reviews', name: 'app_review')]
    public function reviews(int $id, Request $request): JsonResponse
    {
        //TODO: Replace request with an id via argument resolver
        return $this->json($this->reviewService->getReviewPageByBookId(
            $id, $request->get('page', 1)
        ));
    }
}
