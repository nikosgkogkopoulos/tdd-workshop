<?php

namespace App\Http\Controllers;

class BowlingCalculator extends Controller
{

    private bool $next_throw_is_double = false;
    public function calculateScore(array $throws):int
    {
        $total_score = 0;
        $frames = [];

        // create frames
        while(count($throws) >= 2){
            $frame = [$throws[0], $throws[1]];
            $frames[] = $frame;
            $throws = $this->removeAlreadyUsedThrows($throws);
        }

        // calculate frames
        foreach($frames as $current_frame){
            $current_frame_score = $current_frame[0] + $current_frame[1];
            if($this->next_throw_is_double === true){
                $total_frame_score = $current_frame_score + $current_frame[0];
                $this->next_throw_is_double = false;
            }
            else{
                $total_frame_score = $current_frame_score;
            }

            $this->checkIfSpare($current_frame_score);

            $total_score += $total_frame_score;
            $frames = $this->removeAlreadyUsedFrames($frames);
        }

        // calculate throws
        foreach($throws as $throw){
            if($this->next_throw_is_double === true){
                $total_score += ($throw * 2);
                $this->next_throw_is_double = false;
            }else{
                $total_score += $throw;
            }
        }

        return $total_score;
    }

    private function checkIfSpare( $current_frame_score):void
    {
        if($current_frame_score == 10){
            $this->next_throw_is_double = true;
        }
    }

    private function removeAlreadyUsedThrows(array $throws):array
    {
        unset($throws[0]);
        unset($throws[1]);
        return array_values($throws);
    }

    private function removeAlreadyUsedFrames(array $frames):array
    {
        unset($frames[0]);
        return array_values($frames);
    }
}
