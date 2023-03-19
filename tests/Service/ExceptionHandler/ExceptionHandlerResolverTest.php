<?php

namespace App\Service\ExceptionHandler;

use App\Tests\AbstractTestCase;
use InvalidArgumentException;
use LogicException;

class ExceptionHandlerResolverTest extends AbstractTestCase
{
    public function testThrowsExceptionOnEmptyCode()
    {
        $this->expectException(InvalidArgumentException::class);

        new ExceptionMappingResolver(['someClass' => ['hidden' => true]]);
    }

    public function testResolveReturnNullWhenNotFound()
    {
        $resolver = new ExceptionMappingResolver([]);

        $this->assertNull($resolver->resolve(InvalidArgumentException::class));
    }

    public function testResolvesClassItself()
    {
        $resolver = new ExceptionMappingResolver([InvalidArgumentException::class => ['code' => 400]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertEquals(400, $mapping->getCode());
    }

    public function testResolvesSubclass()
    {
        $resolver = new ExceptionMappingResolver([LogicException::class => ['code' => 500]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertEquals(500, $mapping->getCode());
    }

    public function testResolvesHidden()
    {
        $resolver = new ExceptionMappingResolver([LogicException::class => ['code' => 500, 'hidden' => false]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertFalse($mapping->isHidden());
    }

    public function testResolvesLoggable()
    {
        $resolver = new ExceptionMappingResolver([LogicException::class => ['code' => 500, 'loggable' => true]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertTrue($mapping->isLoggable());
    }

    public function testResolvesDefaultValues()
    {
        $resolver = new ExceptionMappingResolver([InvalidArgumentException::class => ['code' => 400]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertTrue($mapping->isHidden());
        $this->assertFalse($mapping->isLoggable());
    }
}