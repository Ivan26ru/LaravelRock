<?php

declare(strict_types=1);

namespace App\Policies;

use App\Domain\Models\Post\Post;
use App\Domain\Models\User;

// @todo не использовал так как должна принимать модель, а я работаю с $postId

/**
 * @deprecated
 */
class PostPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $post->author_id === $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update2(User $user): bool
    {
        return true;
    }
}
