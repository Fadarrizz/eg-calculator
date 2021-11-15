<?php

namespace TestCase;

class Command
{
    private const options = [
        1 => [
            'method' => 'calcDivisors',
            'input' => [
                'question' => 'Provide a number:',
                'type' => self::INT_INPUT,
            ]
        ],
        2 => [
            'method' => 'calcFactorial',
            'input' => [
                'question' => 'Provide a number:',
                'type' => self::INT_INPUT,
            ]
        ],
        3 => [
            'method' => 'calcPrimeNumbers',
            'input' => [
                'question' => 'Please provide a list of numbers (comma separated):',
                'type' => self::ARRAY_INPUT,
            ]
        ],
    ];
    private const INT_INPUT = 1;
    private const ARRAY_INPUT = 2;
    private $calculator;
    private ListRenderer $listRenderer;
    private int $option;

    public function __construct($calculator, ListRenderer $listRenderer)
    {
        $this->calculator = $calculator;
        $this->listRenderer = $listRenderer;
    }

    public function run()
    {
        do {
            $option = readline("Choose an option: \n." .
                "1: divisors, 2: factorial, 3: primes\n");
        } while (! array_key_exists((int)$option, self::options));

        $this->option = (int) $option;

        $input = $this->getInput(
            $this->getOptionInputConfig()['question'],
            $this->getOptionInputConfig()['type']
        );

        try {
            $result = $this->runCalculation($this->getOptionMethod(), $input);

            echo "\n".$this->listRenderer->render($this->getOptionTitle(), $result);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function getInput($question, $type)
    {
        if ($type === self::INT_INPUT) {
            return $this->getIntegerInput($question);
        }

        if ($type === self::ARRAY_INPUT) {
            return $this->getArrayInput($question);
        }

        return false;
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

    private function getOptionInputConfig()
    {
        return self::options[$this->option]['input'];
    }

    private function getOptionMethod()
    {
        return self::options[$this->option]['method'];
    }

    private function getOptionTitle()
    {
        $method = $this->getOptionMethod();

        $title = str_replace('calc', '', $method);

        return strtolower($title[0]) . substr($title, 1);
    }

    private function runCalculation($method, $input)
    {
        return $this->calculator->{$method}($input);
    }
}
