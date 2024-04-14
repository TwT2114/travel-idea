<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanIdeaController extends Controller
{

    /**
     * Get the planIdeas by planId.
     */
    public function getPlanIdeas(string $planId)
    {
        $planIdeas = PlanIdea::where('plan_id', $planId)->get();

        return view('plan.edit', compact('planIdeas'));
    }


    public function getAllPlanIdeas()
    {
        return PlanIdea::all();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

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
    public function show(PlanIdea $planIdea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanIdea $planIdea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlanIdea $planIdea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $planIdeaId)
    {
        //
        // check if the plan belongs to the current user

        $planIdea = PlanIdea::find($planIdeaId);
        if ($planIdea) {
            // check if the plan belongs to the current user
            $plan = Plan::find($planIdea->plan_id);

            if ($plan->user_id == Auth::id()) {
                // delete the planned idea
                $planIdea->delete();
                return redirect(route('plan.edit', $plan->id))->with('success', 'Plan idea deleted successfully.');
            } else {
                return redirect(route('plan.show'))->with('error', 'You are not allowed to delete this plan-idea.');
            }
        } else {
            return redirect(route('plan.index'))->with('error', 'Plan-idea not found.');
        }

    }
}
