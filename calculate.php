<?php

use TestCase\Calculator;

require(__DIR__."/src/Calculator.php");

echo (new Calculator())->calcPrimeNumbers([4, 8, 15, 16, 23, 42]);
