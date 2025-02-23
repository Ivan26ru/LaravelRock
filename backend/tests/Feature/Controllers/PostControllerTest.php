<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use App\Domain\Models\Post\Post;
use App\Domain\Models\User;
use App\Domain\Query\Posts\ShowQuery\AuthorDTO;
use App\Domain\Repositories\PostsRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

#[Group('GroupController')]
class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Гостям просмотр запрещен
     * @return void
     */
    public function test_secure_area_restricted_to_guests(): void
    {
        $response = $this->get('/posts/secure', ['accept' => 'application/json']);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Разрешен вход авторизированным юзерам
     * @return void
     */
    public function test_secure_area_showed_for_authorized_users(): void
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this->get('/posts/secure');
        $response->assertStatus(Response::HTTP_OK);
    }


    /**
     * Проверка какой блейд шаблон возвращает post контроллер и наборы данных если есть
     * @return void
     */
    public function test_posts_index_is_rendered_correctly(): void
    {
        $url = '/posts';
        $routeName = 'posts.index';
        $bladeView = 'posts.index';
        $varName = ['posts', 'filters'];
        // Выполняем GET-запрос по конкретному URL
        $response = $this->get($url);

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name: ' . $routeName);

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(RESPONSE::HTTP_OK);

        // Проверяем, что рендерится нужное представление
        $response->assertViewIs($bladeView, 'Не верный blade');

        // Проверяем, что в представлении есть переменная 'mySkills' с нужными значениями
        $response->assertViewHas($varName);
    }

    /**
     * Просмотр поста
     * @return void
     */
    public function test_post_show_correct(): void
    {
        $this->instance(
                      PostsRepositoryInterface::class,
            instance: Mockery::mock(PostsRepositoryInterface::class, function (MockInterface $mock) {
                          $mock->shouldReceive('find')
                              ->with(1) // Ожидаем вызов с аргументом 1
                              ->andReturn($this->mockPost1());
                      })
        );

        $url = '/posts/1';
        $routeName = 'posts.show';
        $bladeView = 'posts.show';
        $varName = ['post'];
        $response = $this->get($url);

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name: ' . $routeName);

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(RESPONSE::HTTP_OK);

        // Проверяем, что рендерится нужное представление
        $response->assertViewIs($bladeView, 'Не верный blade');

        // Проверяем, что в представлении есть переменная 'mySkills' с нужными значениями
        $response->assertViewHas($varName);
    }

    /**
     * Пост не найден 404
     * @return void
     */
    public function test_post_show_no_correct(): void
    {
        $this->instance(
                      PostsRepositoryInterface::class,
            instance: Mockery::mock(PostsRepositoryInterface::class, function (MockInterface $mock) {
                          // Создаем поддельный объект Post
                          $mock->shouldReceive('find')
                              ->with(2) // Ожидаем вызов с аргументом 1
                              ->andReturn(null);
                      })
        );
        $url = '/posts/2';
        $routeName = 'posts.show';
        $response = $this->get($url);

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name: ' . $routeName);

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(RESPONSE::HTTP_NOT_FOUND);
    }

    public function test_post_form()
    {
        $url = '/posts/1/edit';
        $routeName = 'posts.edit';
        $response = $this->get($url);

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name: ' . $routeName);

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(RESPONSE::HTTP_FOUND);
    }

    public function test_post_update()
    {
        $url = '/posts/1/edit';
        $routeName = 'posts.update';
        $response = $this->post($url);

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name: ' . $routeName);

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(RESPONSE::HTTP_FOUND);
    }

    public function test_post_form_correct()
    {
        $this->instance(
                      PostsRepositoryInterface::class,
            instance: Mockery::mock(PostsRepositoryInterface::class, function (MockInterface $mock) {
                          $mock->shouldReceive('find')
                              ->with(1) // Ожидаем вызов с аргументом 1
                              ->andReturn($this->mockPost1());
                          $mock->shouldReceive('getAuthorIdPost')
                              ->with(1) // Ожидаем вызов с аргументом 1
                              ->andReturn(1);
                      })
        );

        $this->actingAs(
            User::factory()->create(['id' => 1, 'email' => 'test@mail.com'])
        );

        $url = '/posts/1/edit';
        $routeName = 'posts.edit';
        $response = $this->get($url);
        $bladeView = 'posts.edit';
        $varName = ['post'];

        // Вызываем маршрут или контроллер
        $this->assertTrue(request()->routeIs($routeName), 'Не верный rote name: ' . $routeName);

        // Проверяем, что возвращается успешный HTTP-ответ
        $response->assertStatus(RESPONSE::HTTP_OK);

        // Проверяем, что рендерится нужное представление
        $response->assertViewIs($bladeView, 'Не верный blade');

        // Проверяем, что в представлении есть переменная 'mySkills' с нужными значениями
        $response->assertViewHas($varName);
    }

    private function mockPost1(): Post
    {
        $post = new Post();
        return $post->forceFill(
            [
                'id'         => 1,
                'title'      => 'test',
                'content'    => 'testContent2',
                'created_at' => '2020-01-01 12:00:00',
                'author'     => new AuthorDTO(
                    email: 'test@mail.com',
                    name : 'tessUser'
                ),
            ]
        );
    }
}
