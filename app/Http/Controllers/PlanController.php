<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Plan;
use App\Models\PlanIdea;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $plans = Plan::all();
        return view('plan.index', compact('plans'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $plan = new Plan();
        return view('plan.create', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store the new plan into database
        // 1. validate the inputted data
        $request->validate([
            'title' => 'required|max:255|min:3',
        ]);

        // 2. create a new idea model
        $plan = new Plan([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'title' => $request->get('title'),
        ]);

        // 3. save the data into database
        $plan->save();

        $newPlan = Plan::where('user_id', Auth::id())->latest()->first();

        // 4. redirect to the plan index page
        return redirect()->route('plan.edit', $newPlan->id)->with('success', 'Plan created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $plan = Plan::find($id);
        return view('plan.show', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // edit plan

        $plan = Plan::find($id);

        // check if the plan belongs to the current user
        if ($plan->user_id != Auth::id()) {
            return redirect()->route('plan.index')->with('error', 'You are not allowed to edit this plan.');
        } else {

            // get all the ideas related to the plan
            $planIdeas = Idea::whereIn('id', function (Builder $query) use ($id) {
                $query->select('idea_id')->from('plan_ideas')->where('plan_id', $id);
            })->get();

            // get all the ideas that are not related to the plan
            $ideas = Idea::whereNotIn('id', function (Builder $query) use ($id) {
                $query->select('idea_id')->from('plan_ideas')->where('plan_id', $id);
            })->get();

            return view('plan.edit', compact('plan', 'planIdeas', 'ideas'));
        }

    }

    /**
     * Add idea to plan
     */
    public function addIdea(string $planId, string $ideaId)
    {

    }

    /**
     * Remove idea from plan
     */
    public function removeIdea(string $planId, string $ideaId)
    {

    }
    /**
     * Remove all idea from plan
     */
    public function removeAllIdeas(string $planId)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
