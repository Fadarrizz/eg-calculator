<?php

declare(strict_types=1);

namespace TestCase;

class Calculator
{
    public function calcDivisors(int $number): array
    {
        $divisors = [];

        if ($this->isPrime($number)) {
            throw new \InvalidArgumentException('Number cannot be a prime number');
        }

        for ($i = 2; $i < $number; $i++) {
            if ($number % $i === 0) {
                $divisors[] = $i;
            }
        }

        return $divisors;
    }

    public function calcFactorial(int $number): int
    {
        if ($number < 0 || $number > 12) {
            throw new \InvalidArgumentException('Number cannot be below 0 or higher than 12');
        }

        if ($number === 1) {
            return 1;
        }

        return $number * $this->calcFactorial($number - 1);
    }

    public function calcPrimeNumbers(array $numbers)
    {
        return array_values(
            array_filter($numbers, function ($number) {
                return $this->isPrime($number);
            })
        );
    }

    private function isPrime(int $number): bool
    {
        if ($number < 2) {
            return false;
        }

        if ($number === 2) {
            return true;
        }

        $sqrt = sqrt($number);
        for ($i = 2; $i <= $sqrt; $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    }
}
