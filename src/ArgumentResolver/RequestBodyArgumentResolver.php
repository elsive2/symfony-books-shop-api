<?php

namespace App\ArgumentResolver;

use App\Attribute\RequestBody;
use App\Exception\RequestBodyConvertException;
use App\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

class RequestBodyArgumentResolver implements ValueResolverInterface
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator
    ) { }
    
	/**
	 * Whether this resolver can resolve the value for the given ArgumentMetadata.
	 *
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @param \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument
	 * @return bool
	 */
	public function supports(Request $request, ArgumentMetadata $argument): bool 
    {
        return count($argument->getAttributes(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF)) > 0;
	}
	
	/**
	 * Returns the possible value(s).
	 *
	 * @param \Symfony\Component\HttpFoundation\Request $request
	 * @param \Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata $argument
	 * @return \Traversable|array
	 */
	public function resolve(Request $request, ArgumentMetadata $argument): iterable 
    {
        try {
            $model = $this->serializer->deserialize(
                $request->getContent(), 
                $argument->getType(), 
                JsonEncoder::FORMAT
            );
        } catch (Throwable $throwable) {
            throw new RequestBodyConvertException($throwable);
        }

        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        yield $model;
	}
}