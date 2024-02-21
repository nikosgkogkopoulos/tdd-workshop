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
        $this->assertEquals($expected_result, $result);
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
        $this->assertEquals($expected_result, $result);
    }

    /**
     * @test
     */
    public function it_returns_twelve_for_1_spare_with_four_and_six_and_1_pin_hit(): void
    {
        // ARRANGE
        $expected_result = 12;

        // ACT
        $result = app(BowlingCalculator::class)->calculateScore([4,6,1]);

        // ASSERT
        $this->assertEquals($expected_result, $result);
    }

    /**
     * @test
     */
    public function it_returns_ten_for_no_spare_with_4_5_and_1_pin_hit(): void
    {
        // ARRANGE
        $expected_result = 10;

        // ACT
        $result = app(BowlingCalculator::class)->calculateScore([4,5,1,0]);

        // ASSERT
        $this->assertEquals($expected_result, $result);
    }

    /**
     * @test
     */
    public function it_returns_33_after_back_to_back_spares(): void
    {
        // ARRANGE
        $expected_result = 33;

        // ACT
        $result = app(BowlingCalculator::class)->calculateScore([4,6,1,9,5,2]);

        // ASSERT
        $this->assertEquals($expected_result, $result);
    }
}
