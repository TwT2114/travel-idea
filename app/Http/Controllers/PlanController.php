<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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
            'title' => 'required',
        ]);

        // 2. create a new idea model
        $plan = new Plan([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'title' => $request->get('title'),
        ]);

        // 3. save the data into database
        $plan->save();

        // 4. redirect to the plan index page
        return redirect()->route('plan.index')->with('success', 'Plan created successfully.');



    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
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
