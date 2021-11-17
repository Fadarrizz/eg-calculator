<?php

use Fadarrizz\EgCalculator\Calculator;
use Fadarrizz\EgCalculator\Command;
use Fadarrizz\EgCalculator\XmlListRenderer;

require_once "vendor/autoload.php";

$calculator = new Calculator;

$listRenderer = new XmlListRenderer();

(new Command($calculator, $listRenderer))->run();
