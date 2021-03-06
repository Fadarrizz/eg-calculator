<?php

namespace Fadarrizz\EgCalculator\Tests;

use Fadarrizz\EgCalculator\Calculator;

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
        $calculator = new Calculator;

        $this->assertEquals([2, 3, 5], $calculator->calcPrimeNumbers([0, 1, 2, 3, 4, 5, 6]));

        $this->assertEquals([23], $calculator->calcPrimeNumbers([4, 8, 15, 16, 23, 42]));

        $this->assertEquals([4597, 7057, 1399], $calculator->calcPrimeNumbers([4597, 1664, 7057, 854, 1399]));

        $this->assertEquals([], $calculator->calcPrimeNumbers([-1, -12, -4, -8]));
    }
}
