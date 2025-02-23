<?php

namespace Tests\Unit;

use App\Domain\Models\Name;
use App\Domain\Models\Post\Email;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

#[Group('GroupUnit')]
class EmailVOTest extends TestCase
{

    #[DataProvider('dataEmailValid')]
    public function test_email_vo(string $expected, string $email): void
    {
        $email = new Email($email);
        $this->assertEquals($expected, $email->email);
    }

    public static function dataEmailValid(): array
    {
        return [
            'Валидное значение' => [
                'correct@mail.ru',
                'correct@mail.ru',
            ],
            'Еще валидное'      => [
                '123@mail.ru',
                '123@mail.ru',
            ]
        ];
    }

    #[DataProvider('dataEmailVoException')]
    public function test_email_vo_exception(string $expected, string $email): void
    {
        if ($expected) {
            $this->expectException($expected);
        }

        new Email($email);
    }

    public static function dataEmailVoException(): array
    {
        return [
            'Пустое значение'    => [
                InvalidArgumentException::class,
                '',
            ],
            'Не валидный адрес'  => [
                InvalidArgumentException::class,
                'mail-no-work',
            ],
            'Не валидный адрес2' => [
                InvalidArgumentException::class,
                'mail-no-work@@',
            ],
            'Не валидный адрес3' => [
                InvalidArgumentException::class,
                'mail-no-work.com',
            ],

        ];
    }

}
