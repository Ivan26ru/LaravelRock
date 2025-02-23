<?php

namespace App\Presentation\Controllers;

use App\Domain\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => ['required'],
            'post_id' => ['required', 'exists:posts'],
            'user_id' => ['required', 'exists:users'],
        ]);

        return Comment::create($data);
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'message' => ['required'],
            'post_id' => ['required', 'exists:posts'],
            'user_id' => ['required', 'exists:users'],
        ]);

        $comment->update($data);

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json();
    }
}
