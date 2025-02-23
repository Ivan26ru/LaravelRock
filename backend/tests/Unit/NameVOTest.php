<?php

namespace Tests\Unit;

use App\Domain\Models\Name;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

/**
 * Проверка Name VO for Models
 */
#[Group('GroupUnit')]
class NameVOTest extends TestCase
{
    #[DataProvider('dataCheckNameVo')]
    public function test_check_name_get_full_name(
        string $expected,
        string $firstName,
        string $lastName,
        ?string $middleName
    ): void {
        $nameVO = new Name($firstName, $lastName, $middleName);
        $this->assertEquals($expected, $nameVO->getFullName());
    }

    public static function dataCheckNameVo(): array
    {
        return [
            'Данные верно введены'   => [
                'Фамилия Имя Отчество',
                'Фамилия',
                'Имя',
                'Отчество'
            ],
            'Отчество пустая строка' => [
                'Фамилия Имя',
                'Фамилия',
                'Имя',
                ''
            ],
        ];
    }

    #[DataProvider('dataCheckNameVoException')]
    public function test_check_name_vo_exception($expected, $firstName, $lastName, $middleName): void
    {
        if ($expected) {
            $this->expectException($expected);
        }

        new Name($firstName, $lastName, $middleName);

        if (!$expected) {
            $this->assertTrue(true);
        }
    }

    public static function dataCheckNameVoException(): array
    {
        return [
            'Нет имени и фамилии' => [
                InvalidArgumentException::class,
                '',
                '',
                ''
            ],
            'Нет имени'           => [
                InvalidArgumentException::class,
                'Фамилия',
                '',
                ''
            ],
            'Нет фамилии'         => [
                InvalidArgumentException::class,
                '',
                'Имя',
                ''
            ],
        ];
    }
}
