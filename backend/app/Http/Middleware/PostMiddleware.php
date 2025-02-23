<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Domain\Repositories\PostsRepositoryInterface;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

readonly class PostMiddleware
{

    public function __construct(private PostsRepositoryInterface $postsRepository)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string ...$permissions
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string ...$permissions)
    {
        $user = $request->user();
        $postId = (int)$request->route('postId');
        $postAuthorId = $this->postsRepository->getAuthorIdPost($postId);

        if ($user === null) {
            abort(403);
        }

        if ($user->id !== $postAuthorId
            // @todo придумать как можно соеденить для того, что б независимо использовать роли
            && !$user->isAdmin()
        ) {
            abort(403);
        }


        return $next($request);
    }
}
