<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;

class CommentController extends Controller
{

    public function index()
    {
        return view('comment.index', [
            'movies' => Movie::orderBy('updated_at', 'desc')->get()
        ]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
