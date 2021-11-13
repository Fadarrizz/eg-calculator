<?php

declare(strict_types=1);

namespace TestCase\Tests;

use TestCase\Calculator;

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function it_can_calculate_all_divisors_of_a_number()
    {
        $result = (new Calculator)->calcDivisors(12);

        $this->assertEquals([2, 3, 4, 6], $result);
    }

    /** @test */
    public function it_returns_an_empty_array_when_input_is_zero()
    {
        $calculator = new Calculator;

        $this->assertEquals([], $calculator->calcDivisors(0));

        $this->assertEquals([], $calculator->calcDivisors(1));
    }

    /**
     * @dataProvider PrimeProvider
     * @test
     */
    public function input_cannot_be_a_prime_number_when_calculating_divisors($prime)
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Calculator)->calcDivisors($prime);
    }

    public function primeProvider()
    {
        return [ [2], [3], [5], [7], [ 11 ],[13], [17] ];
    }

    /** @test */
    public function it_can_calculate_the_factorial_of_a_number()
    {
        $calculator = new Calculator;

        $this->assertEquals(2, $calculator->calcFactorial(2));

        $this->assertEquals(40320, $calculator->calcFactorial(8));

        $this->assertEquals(479001600, $calculator->calcFactorial(12));
    }

    /** @test */
    public function input_cannot_be_lower_than_0_when_calculating_factorials()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Calculator)->calcFactorial(-1);
    }

    /** @test */
    public function input_cannot_be_higher_than_12_when_calculating_factorials()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Calculator)->calcFactorial(13);
    }

    /** @test */
    public function it_can_calculate_prime_numbers()
    {
        $result = (new Calculator())->calcPrimeNumbers([4, 8, 15, 16, 23, 42]);

        $this->assertStringContainsString("<number>23</number>", $result);
    }
}
