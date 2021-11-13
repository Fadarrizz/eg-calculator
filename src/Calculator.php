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
        $primes = array_filter($numbers, function ($number) {
            return $this->isPrime($number);
        });

        $xmlOutput = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xmlOutput .= "<primeNumbers amount=\"".count($primes)."\">\n";
        $xmlOutput .= "\t<result>\n";

        foreach ($primes as $prime) {
            $xmlOutput .= "\t\t<number>$prime</number>\n";
        }

        $xmlOutput .= "\t</result>\n";
        $xmlOutput .= "</primeNumbers>\n";

        return $xmlOutput;
    }

    private function isPrime(int $number): bool
    {
        if ($number === 0 || $number === 1) {
            return false;
        }

        if ($number === 2) {
            return true;
        }

        for ($i = 2; $i < sqrt($number); $i++) {
            if ($number % $i === 0) {
                return false;
            }
        }

        return true;
    }
}
