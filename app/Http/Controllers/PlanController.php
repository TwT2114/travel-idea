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
        $plans = Plan::latest()->get();
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

        // 4. redirect to the plan edit page to add ideas to plan
        return redirect()->route('plan.edit', $newPlan->id)->with('success', 'Plan created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // get Plan by id
        $plan = Plan::find($id);
        // check if the plan exist
        if ($plan) {
            $planIdeas = Idea::whereIn('id', function (Builder $query) use ($id) {
                $query->select('idea_id')->from('plan_ideas')->where('plan_id', $id);
            })->orderBy('start_date')->get();
            // check if the plan contains ideas
            if ($planIdeas) {
                // get the location of the plan
                // check the # of the locations
                if (count($planIdeas) > 1) {
                    // set origin and destination if there are more than 1 location
                    $loc = "origin="
                        . $planIdeas[0]->latitude . ","
                        . $planIdeas[0]->longitude
                        . "&destination="
                        . $planIdeas[count($planIdeas) - 1]->latitude . ","
                        . $planIdeas[count($planIdeas) - 1]->longitude;
                    // set 1 waypoint if there are more than 2 locations
                    if (count($planIdeas) > 2) {
                        $loc .= "&waypoints=" . $planIdeas[1]->latitude . "," . $planIdeas[1]->longitude;
                        if (count($planIdeas) > 3) {
                            // set waypoints if there are more than 3 locations
                            for ($i = 2; $i < count($planIdeas) - 1; $i++) {
                                $loc .= "|" . $planIdeas[$i]->latitude . "," . $planIdeas[$i]->longitude;
                            }
                        }
                    }
                    $plan->loc = $loc;
                }
            }
            return view('plan.show', compact('plan', 'planIdeas'));
        } else {
            return redirect(route('plan.index'))->with('error', 'Plan not found.');
        }

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
            })->latest()->get();

            return view('plan.edit', compact('plan', 'planIdeas', 'ideas'));
        }

    }

    /**
     * Add idea to plan
     */
    public function addIdea(Request $request)
    {
        // 1. validate the inputted data
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'idea_id' => 'required|exists:ideas,id',
        ]);

        // 2. get the id
        $planId = $request->get('plan_id');
        $ideaId = $request->get('idea_id');

        // check if the plan belongs to the current user
        if (Plan::where('user_id', Auth::id())->where('id', $planId)->exists()) {
            // check if the idea is already related to the plan
            if (PlanIdea::where('plan_id', $planId)->where('idea_id', $ideaId)->exists()) {
                return redirect()->route('plan.edit', $planId)->with('error', 'Idea is already related to the plan.');

            } else {

                // add idea to plan
                $planIdea = new PlanIdea([
                    'plan_id' => $planId,
                    'idea_id' => $ideaId,
                ]);

                $planIdea->save();

                return redirect()->route('plan.edit', $planId)->with('success', 'Idea added to plan successfully.');

            }
        } else {
            return redirect()->route('plan.index')->with('error', 'You are not allowed to edit this plan.');
        }
    }


    /**
     * Remove all idea from plan
     */
    public function removeAllIdeas(string $planId)
    {
        // delete all the related ideas in plan_ideas table
        $plan = Plan::find($planId);
        if ($plan) {
            if ($plan->user_id == Auth::id()) {
                PlanIdea::where('plan_id', $planId)->delete();
                return redirect(route('plan.edit', $planId))
                    ->with('success', 'All ideas removed from plan successfully');
            } else {
                return redirect(route('plan.show'))->with('error', 'No Authorization to remove ideas from this plan');
            }
        } else {
            return redirect(route('plan.index'))->with('error', 'Plan not exist');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the inputted data
        $request->validate([
            'title' => 'required|max:255|min:3',
        ]);
        // 2. get the data by id
        $plan = Plan::find($id);

        // check user
        if ($plan->user_id == Auth::id()) {
            // update the data
            $plan->title = $request->get('title');
        }

        // save the data
        $plan->save();
        return redirect(route('plan.show', $plan->id))->with('success', 'Plan updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // get Plan by id
        $plan = Plan::find($id);

        // check if the plan exist
        if ($plan) {
            // check Authorization
            if ($plan->user_id == Auth::id()) {
                $plan->delete();

                // delete all the related ideas in plan_ideas table
                PlanIdea::where('plan_id', $id)->delete();

                // redirect to the plan index page
                return redirect(route('plan.index'))->with('success', 'Plan has been deleted');
            } else {
                return redirect(route('plan.show', $plan->id))->with('fail', 'No Authorization to delete this plan');
            }
        } else {
            return redirect(route('plan.index'))->with('fail', 'Idea not exist');
        }
    }
}
