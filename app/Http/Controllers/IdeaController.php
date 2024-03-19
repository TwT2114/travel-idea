<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function searchByDestination(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $userId = auth()->user()->id; // get user id
        $results = TravelIdea::where('destination', 'like', '%' . $searchTerm . '%')
            ->where('user_id', $userId) // only show own data
            ->get();
              //如何显示多个tags的搜索结果？
        return view('search-results', ['results' => $results]);
    }

    public function searchByTag(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $userId = auth()->user()->id;
        $results= "";
        //数据库查询逻辑

        return view('search-results', ['results' => $results]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
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
