<?php

namespace App\Http\Controllers;

class BowlingCalculator extends Controller
{
    public function calculateScore(array $frames):int
    {
        $total_score = 0;

        foreach($frames as $frame){
            $total_score += $frame;
        }

        return $total_score;
    }
}
