<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Posts;

use App\Domain\Query\Posts\ShowQuery\Fetcher;
use App\Domain\Query\Posts\ShowQuery\ModelNotFoundException;
use App\Domain\Query\Posts\ShowQuery\Query;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory;

final readonly class Show
{
    public function __invoke(
        Fetcher $useCase,
        Factory $viewFactory,
        int $postId
    ): View {
        try {
            $post = $useCase(new Query($postId));
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
        return $viewFactory->make('posts.show', compact('post'));
    }
}
