<?php

namespace TestCase;

use XMLWriter;

class XmlListRenderer implements ListRenderer
{
    public function __construct()
    {
        $this->writer = new XMLWriter();
    }

    public function render($title, $list)
    {
        if (! is_array($list)) {
            $list = [$list];
        }

        $this->writer->openMemory();
        $this->writer->setIndent(true);
        $this->writer->startDocument();

        $this->writer->startElement($title);
        $this->writer->writeAttribute('amount', count($list));

        $this->writer->startElement('result');

        foreach ($list as $number) {
            $this->writer->writeElement('number', $number);
        }

        $this->writer->endElement();
        $this->writer->endElement();

        return $this->writer->outputMemory();
    }
}
