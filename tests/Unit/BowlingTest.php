<?php

namespace Tests\Unit;

use App\Http\Controllers\BowlingCalculator;
use PHPUnit\Framework\TestCase;

class BowlingTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_returns_zero_for_0_throws()
    {
        // ARRANGE
        $expected_result = 0;

        // ACT
        $result = app(BowlingCalculator::class)->calculateScore([]);

        // ASSERT
        $this->assertEquals($result, $expected_result);
    }
}
