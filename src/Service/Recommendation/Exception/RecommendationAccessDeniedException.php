<?php

namespace App\Service\Recommendation\Exception;

use Throwable;

final class RecommendationAccessDeniedException extends RecommendationException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct('access denied', $previous);
    }
}