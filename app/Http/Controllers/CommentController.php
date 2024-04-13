<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(String $id)
    {
        $idea = Idea::findOrFail($id);
        $comments = $idea->comments;
        $authorName = Idea::where('user_id', $idea->user_id)->value('user_name');
        return view('idea.show', compact('idea', 'comments', 'authorName'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, String $id)
    {
        $idea = Idea::findOrFail($id);
        //validation
        $request->validate([
            'content' => 'required|max:255',
            'idea_id' => 'required|exists:ideas,id'
        ]);
        //创建评论
        $newComment = new Comment();
        $newComment->user_id = auth()->user()->id;
        $newComment->idea_id = $request->input('idea_id'); // Using the idea_id from form input
        $newComment->content = $request->input('content');
        $newComment->save();


        $authorName = Idea::where('user_id', auth()->user()->id)->value('user_name');
        return redirect()->route('ideas.show', $id)->with('success', 'Comment submitted successfully')->with('authorName', $authorName);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
