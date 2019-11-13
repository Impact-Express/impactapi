<?php

namespace App\Services\Csv;

use League\Csv\Writer;

class Csv
{
    private $csv;

    public function __construct() {
        $this->init();
    }

    private function init() {
        $this->csv = Writer::createFromString('');
    }

    public function setHeader(array $header) {
        $this->csv->insertOne($header);
    }

    public function setRecords(array $records) {
        $this->csv->insertAll($records);
    }

    public function getContent() {
        return $this->csv->getContent();
    }
}