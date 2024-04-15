<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $id = $request->get('idea_id');
        // $idea = Idea::find($id);

        $idea = Idea::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc')->take(10); // 限制只获取最新的 10 条评论
        }])->find($id);

        $comments = $idea->comments->map(function ($comment) {
            return [
                'id'=> $comment->id,
                'user_name' => $comment->user_name,
                'content' => $comment->content,
                'created_at' => $comment->created_at,
            ];
        });
        return response()->json($comments);
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
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'content' => 'required|max:255',
        ]);
        //创建评论
        $id = $request->get('idea_id');
        $idea = Idea::find($id);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->idea_id = $idea->id;

        //获取用户名
        $user = User::find(Auth::id());
        $comment->user_name = $user->name;
        $comment->content = $request->get('content');
        $comment->save();

        //评论成功后跳转到该idea
        return redirect()->route('idea.show', $id);
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
