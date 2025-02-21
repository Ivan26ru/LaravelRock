<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Presentation\Controllers\HomeController;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('GroupController')]
#[CoversClass(HomeController::class)]
class PageControllerTest extends TestCase
{

    /**
     * Проверка какой блейд шаблон возвращает контроллер и наборы данных если есть
     * @param string $url
     * @param string $routeName
     * @param string $bladeView
     * @param string $varName
     * @param string|array $varValue
     * @return void
     */
    #[DataProvider('dataReturnViews')]
    public function test_pages_view_is_rendered_correctly(
        string $url,
        string $routeName,
        string $bladeView,
        string $varName = '',
        string|array $varValue = ''
    ): void {

        // Выполняем GET-запрос по конкретному URL
        $response = $this->get($url);

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name');

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(200);

        // Проверяем, что рендерится нужное представление
        $response->assertViewIs($bladeView, 'Не верный blade');

        // Проверяем, что в представлении есть переменная 'mySkills' с нужными значениями
        $response->assertViewHas($varName, $varValue);
    }

    public static function dataReturnViews(): array
    {
        return [
            'home' => [
                '/',
                'home',
                'page.home',
            ],
            'skills' => [
                '/skills',
                'skills',
                'page.skills',
                'mySkills',
                ['FrontEnd', 'BackEnd'],
            ],
            'dashboard' => [
                '/dashboard',
                'dashboard',
                'page.dashboard',
            ],
        ];
    }
}
