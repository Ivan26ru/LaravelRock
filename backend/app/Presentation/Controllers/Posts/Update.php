<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Posts;

use App\Domain\Commands\Posts\UpdateCommand\Form\Handler as HandlerForm;
use App\Domain\Commands\Posts\UpdateCommand\Update\Command;
use App\Domain\Commands\Posts\UpdateCommand\Update\Handler as HandlerUpdate;
use App\Domain\Commands\Posts\UpdateCommand\Update\ModelNotFoundException;
use App\Presentation\Requests\Post\UpdatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

final readonly class Update
{
    public function form(
        HandlerForm $useCase,
        int $postId
    ): View {
        try {
            $post = $useCase(postId: $postId);
        } catch (ModelNotFoundException $e) {
            \Log::error($e->getMessage());
            abort(code: RESPONSE::HTTP_NOT_FOUND);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(
        UpdatePostRequest $request, // Валидация запроса с помощью Laravel Form Request
        HandlerUpdate $useCase,
        int $postId
    ): RedirectResponse {
        $data = $request->validated();

        try {
            $useCase(
                new Command(
                    $postId,
                    $data['title'],
                    $data['content'],
                )
            );

        } catch (ModelNotFoundException $e) {
            \Log::error($e->getMessage());
            abort(code: RESPONSE::HTTP_NOT_FOUND);
        }

        return new RedirectResponse(route('posts.show', $postId));
    }
}
