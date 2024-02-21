<?php

namespace App\Http\Controllers;

class BowlingCalculator extends Controller
{
    private bool $throws_after_strike = false;

    public function calculateScore(array $throws): int
    {
        $total_score = 0;
        $frames = [];

        // create frames
        while (count($throws) >= 2) {
            if ($throws[0] == 10) {
                $frame = [$throws[0]];
                $throws = $this->removeAlreadyUsedThrows($throws, 1);
            } else {
                $frame = [$throws[0], $throws[1]];
                $throws = $this->removeAlreadyUsedThrows($throws, 2);
            }
            $frames[] = $frame;
        }

        // calculate frames
        foreach ($frames as $index => $current_frame) {
            // Calculate the score for the current frame
            $current_frame_score = array_sum($current_frame);

            // Add the score of the current frame to the total score
            $total_score += $current_frame_score;

            // calculate after strike
            if ($this->throws_after_strike === true) {
                $total_score += $current_frame_score;
                $this->throws_after_strike = false;
            }

            // handle spare
            if ($current_frame_score == 10 && count($current_frame) === 2 && $current_frame[0] !== 10) {
                // If it's not the last frame, add the next frame's first throw as a bonus
                if (isset($frames[$index + 1][0])) {
                    $total_score += $frames[$index + 1][0];
                } else {
                    // If it's the last frame, add the next throw as a bonus
                    $total_score += $throws[0] ?? 0;
                }
            }

            // handle strike
            if ($current_frame_score == 10 && count($current_frame) === 1) {
                $this->throws_after_strike = true;
            }
        }

        // calculate remaining throws
        foreach ($throws as $throw) {
            $total_score += $throw;
        }

        return $total_score;
    }

    private function removeAlreadyUsedThrows(array $throws, int $num_of_throws_to_be_removed):array
    {
        return array_slice($throws, $num_of_throws_to_be_removed);
    }
}
