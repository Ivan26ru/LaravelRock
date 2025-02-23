<?php

namespace Tests\Unit;

use App\Domain\Models\Post\Title;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

#[Group('GroupUnit')]
class TitleVOTest extends TestCase
{

    public function test_email_vo_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Title('');
    }

    public function test_email_vo_correct(): void
    {
        new Title('new title');
        $this->assertTrue(true);
    }
}
