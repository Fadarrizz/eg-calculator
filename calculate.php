<?php

require __DIR__.'/vendor/autoload.php';

use TestCase\Calculator;
use TestCase\Command;
use TestCase\XmlListRenderer;

$calculator = new Calculator;

$listRenderer = new XmlListRenderer();

(new Command($calculator, $listRenderer))->run();
