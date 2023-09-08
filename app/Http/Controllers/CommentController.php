<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Idea $idea) {
        request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $comment = new Comment();
        $comment->idea_id = $idea->id;
        $comment->user_id = auth()->id();
        $comment->content = request()->content;
        $comment->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment posted successfully.');
    }

    public function edit(Idea $idea, Comment $comment) {
        if(auth()->id() !== $comment->user_id) {
            abort(401);
        }
        $editing = true;

        return view('comments.edit', compact('idea', 'comment', 'editing'));
    }

    public function update(Idea $idea, Comment $comment) {
        if(auth()->id() !== $comment->user_id) {
            abort(401);
        }

        request()->validate([
            'content' => 'required|min:5|max:240',
        ]);

        $comment->content = request()->get('content', '');
        $comment->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', 'Comment updated successfully.');
    }
}
