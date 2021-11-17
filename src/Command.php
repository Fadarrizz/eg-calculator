<?php

namespace Fadarrizz\EgCalculator;

class Command
{
    private $calculator;
    private ListRenderer $listRenderer;

    public function __construct($calculator, ListRenderer $listRenderer)
    {
        $this->calculator = $calculator;
        $this->listRenderer = $listRenderer;
    }

    public function run()
    {
        do {
            $option = readline("Choose an option: \n" .
                "1: divisors, 2: factorial, 3: prime numbers\n");
        } while (! in_array((int) $option, [1, 2, 3]));

        if ($option === '1') {
            $input = $this->getIntegerInput('Provide a number:');

            try {
                $result = $this->runCalculation('calcDivisors', $input);

                echo "\n".$this->listRenderer->render('divisors', $result);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }

        if ($option === '2') {
            $input = $this->getIntegerInput('Provide a number:');

            try {
                $result = $this->runCalculation('calcFactorial', $input);

                echo "\n".$this->listRenderer->render('factorial', [$result]);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }

        if ($option === '3') {
            $input = $this->getArrayInput('Please provide a list of numbers (comma separated):');

            try {
                $result = $this->runCalculation('calcPrimeNumbers', $input);

                echo "\n".$this->listRenderer->render('primeNumbers', $result);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }

    private function getIntegerInput($question)
    {
        do {
            $input = readline("\n$question\n");
        } while (! is_numeric($input));

        return (int) $input;
    }

    private function getArrayInput($question)
    {
        do {
            $valid = true;
            $line = readline("\n$question\n");

            $input = [];
            foreach (explode(',', $line) as $key => $value) {
                if (! is_numeric($value)) {
                    $valid = false;
                    break;
                }
                $input[$key] = (int)trim($value);
            }
        } while ($valid === false);

        return $input;
    }

    private function runCalculation($method, $input)
    {
        return $this->calculator->{$method}($input);
    }
}
