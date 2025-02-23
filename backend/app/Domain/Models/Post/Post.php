<?php

namespace App\Domain\Models\Post;

use App\Domain\Models\Comment;
use App\Domain\Models\User;
use Carbon\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }

    protected $fillable = [
        'author_id',
        'title',
        'content',
        'is_draft'
    ];

    public static function create(
        string $title,
        string $content,
        int $authorId,
    ): Post {
        $post = new self();
        $post->title = $title;
        $post->content = $content;
        $post->author_id = $authorId;

        $post->created_at = Carbon::now();

        return $post;
    }

    public function edit(
        Title $title,
        string $content,
    ): Post {
        $this->title = $title->title;
        $this->content = $content;

        return $this;
    }

    /**
     * Пример мутатора как альтернатива прямой записи в свойства или сеттерам.
     * Мутаторы переводят модель из одного валидного состояния в другое.
     * Имеют правила валидации (Ассерты), чтобы обеспечить это требования
     */
    public function updateContent(
        string $title,
        string $content
    ): void {
        if ($this->hasBadWord($title)) {
            throw new \InvalidArgumentException();
        }

        $this->setAttribute('title', $title);
        $this->setAttribute('content', $content);
    }

    /**
     * Еще пример осмысленного мутатора, который не допускает перевод модели в опубликованное состояние,
     * если не соблюдаются условия.
     */
    public function publish(): void
    {
        if ($this->title === '' || $this->content === '') {
            throw new \LogicException('Post must have a title and content');
        }

        $this->is_draft = false;
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
