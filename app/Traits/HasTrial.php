<?php

namespace App\Traits;

use App\Models\Plan;

trait HasTrial
{
    public function giveTrialIfEligible(): void
    {
        if ($this->has_had_trial || $this->purchases()->exists()) {
            return;
        }

        $trialPlan = Plan::where('slug', 'free-trial')->first();

        if (!$trialPlan) {
            return;
        }

        $start = now();
        $end = match ($trialPlan->duration_unit) {
            'day' => $start->copy()->addDays($trialPlan->duration),
            'week' => $start->copy()->addWeeks($trialPlan->duration),
            'month' => $start->copy()->addMonths($trialPlan->duration),
            'year' => $start->copy()->addYears($trialPlan->duration),
        };

        $this->purchases()->create([
            'plan_id' => $trialPlan->id,
            'amount_paid' => 0,
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'active',
        ]);

        $this->update(['has_had_trial' => true]);
    }
}
