<?php

declare(strict_types=1);

namespace App\Infrastrusture\Services;

use Psr\Log\LoggerInterface;

class ServiceA
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function doSomething()
    {
        $this->logger->info('TEST MESSAGE');

        return 'test';
    }
}
