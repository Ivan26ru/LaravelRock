<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Posts;

use App\Domain\Query\Posts\IndexQuery\FiltersDTO;
use App\Domain\Query\Posts\IndexQuery\Handler;
use App\Presentation\Requests\Post\IndexPostRequest;
use Illuminate\View\View;

final readonly class Index
{
    public function __invoke(
        IndexPostRequest $request,
        Handler $useCase
    ): View {
        $filtersRequest = $request->validated();

        $postsCollection = $useCase(
            filters: new FiltersDTO(
                authorId: isset($filtersRequest['authorId']) ? (int)$filtersRequest['authorId'] : null,
            )
        );

        $posts = $postsCollection->posts;
        $filters = $postsCollection->filters;
        return view(
            'posts.index',
            compact(
                'posts',
                'filters'
            )
        );
    }
}
