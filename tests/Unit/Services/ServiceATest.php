<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Infrastrusture\Services\ServiceA;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class ServiceATest extends TestCase
{


    public function testDoSomething()
    {
        //        $mockLogger = $this->createMock(LoggerInterface::class)
        //            ->expects($this->once())
        //            ->method('info')
        //            ->with('TEST MESSAGE')
        //            ->willReturn()

        $mockLogger = \Mockery::mock(LoggerInterface::class)
            ->shouldReceive('info')
            ->once() //количество раз сколько должен быть вызван
            ->with('TEST MESSAGE')
            ->getMock();

        $service = new ServiceA($mockLogger);

        $result = $service->doSomething();

        $this->assertSame('test', $result);
    }
}
