<?php

namespace Tests\Unit;

use App\Http\Controllers\BowlingCalculator;
use PHPUnit\Framework\TestCase;

class BowlingTest extends TestCase
{
    /**
     * @test
     */
    public function it_returns_zero_for_0_throws(): void
    {
        // ARRANGE
        $expected_result = 0;

        // ACT
        $result = app(BowlingCalculator::class)->calculateScore([]);

        // ASSERT
        $this->assertEquals($result, $expected_result);
    }

        /**
     * @test
     */
    public function it_returns_one_for_1_pin_hit(): void
    {
        // ARRANGE
        $expected_result = 1;

        // ACT
        $result = app(BowlingCalculator::class)->calculateScore([1]);

        // ASSERT
        $this->assertEquals($result, $expected_result);
    }
}
