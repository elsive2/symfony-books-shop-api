<?php

namespace App\Model;

use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\ErrorDebugDetails;
use App\Model\ErrorValidationDetails;

class ErrorResponse
{
    public function __construct(
        private string $message,
        private int $code,
        private mixed $details = null
    ) { }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @Property(type="object", oneOf={
     *  @Schema(ref=@Model(type=ErrorDebugDetails::class)),
     *  @Schema(ref=@Model(type=ErrorValidationDetails::class))
     * })
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }
}