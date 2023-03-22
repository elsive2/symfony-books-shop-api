<?php

namespace App\Service\Recommendation;

use App\Service\Recommendation\Exception\RecommendationAccessDeniedException;
use App\Service\Recommendation\Exception\RecommendationRequestException;
use App\Service\Recommendation\Model\RecommendationResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RecommendationService
{
    public function __construct(
        private HttpClientInterface $recommendationClient,
        private SerializerInterface $serializer
    ) { }

    public function getRecommendationsByBookId(int $bookId): RecommendationResponse
    {
        try {
            $response = $this->recommendationClient->request('GET', '/api/v1/book/'.$bookId.'/recommendations');
    
            return $this->serializer->deserialize(
                $response->getContent(),
                RecommendationResponse::class,
                JsonEncoder::FORMAT
            );
        } catch (\Throwable $ex) {
            if ($ex instanceof TransportExceptionInterface && Response::HTTP_FORBIDDEN === $ex->getCode()) {
                throw new RecommendationAccessDeniedException($ex);
            }
            throw new RecommendationRequestException($ex->getMessage(), $ex);
        }
    }
}