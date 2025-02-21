<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Posts;

use App\Domain\Commands\Posts\StoreCommand\Store\Command;
use App\Domain\Commands\Posts\StoreCommand\Store\Handler;
use App\Domain\Services\old\Commands\Posts\Adapter\PostCreateAdapter;
use App\Domain\Services\old\Commands\Posts\Command\PostCreateCommand;
use App\Domain\Services\old\Commands\Posts\DTO\PostCreate\PostCreateDto;
use App\Domain\Services\old\Commands\Posts\PostObject;
use App\Presentation\Requests\Post\CreatePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final readonly class Create
{
    public function form(): View
    {
        return view('posts.edit');
    }

    public function store(
        CreatePostRequest $request,
        Handler $useCase
    ): RedirectResponse|View {
        $requestData = $request->validated();

        $useCase(
            new Command(
                title: $requestData['title'],
                content: $requestData['content'],
                authorId: auth()->id()
            )
        );

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }
}
