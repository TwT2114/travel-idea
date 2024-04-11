<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ideas = Idea::all();
        return view('idea.index', compact('ideas'));

    }

    public function searchByDestination(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $userId = auth()->user()->id; // get user id
        $results = Idea::where('destination', 'like', '%' . $searchTerm . '%')
            ->where('user_id', $userId) // only show own data
            ->get();
        //如何显示多个tags的搜索结果？
        return view('search-results', ['results' => $results]);
    }

    public function searchByTag(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $userId = auth()->user()->id;
        $results = "";
        //数据库查询逻辑

        return view('search-results', ['results' => $results]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // create a new idea
        $idea = new Idea();
        return view("idea.create", compact("idea"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store the new idea into database
        // 1. validate the inputted data
        $request->validate([
            'title' => 'required | max:255 |min:3',
            'destination' => 'required | max:255',
            'start_date' => 'required | date',
            'end_date' => 'required | date | after_or_equal:start_date',
        ]);

        // 2. create a new idea model
        $idea = new Idea([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'title' => $request->get('title'),
            'destination' => $request->get('destination'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'tags' => $request->get('tags')
        ]);

        // 3. save the data into database
        $idea->save();
        return redirect('/idea')->with('success', 'Idea has been added');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show the idea
        $idea = Idea::find($id);
        return view('idea.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        // edit the idea

        return view('idea.edit', compact('idea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        //
    }
}
