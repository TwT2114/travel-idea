<?php

namespace App\Http\Controllers;

use App\Models\Plan;

// 导入 Plan 模型

class PlanIdeaController extends Controller
{
    public function removeIdeaFromPlan($planId, $ideaId)
    {
        // 从中间表中分离指定的想法
        $plan = Plan::find($planId);
        $plan->ideas()->detach($ideaId);

        return redirect()->back()->with('success', 'Idea removed from the plan!');
    }
}
