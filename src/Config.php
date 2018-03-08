<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Keboola\Component\Config\BaseConfig;
use Keboola\Csv\CsvFile;

class Config extends BaseConfig
{
    public function getDelimiterFrom(): string
    {
        return $this->getValue(['parameters', 'delimiterFrom']);
    }

    public function getEnclosureFrom(): string
    {
        return $this->getValue(['parameters', 'enclosureFrom']);
    }

    public function getEscapedByFrom(): string
    {
        return $this->getValue(['parameters', 'escapedByFrom'], CsvFile::DEFAULT_ESCAPED_BY);
    }

    public function getDelimiterTo(): string
    {
        return $this->getValue(['parameters', 'delimiterTo']);
    }

    public function getEnclosureTo(): string
    {
        return $this->getValue(['parameters', 'enclosureTo']);
    }

    public function getEscapedByTo(): string
    {
        return $this->getValue(['parameters', 'escapedByTo'], CsvFile::DEFAULT_ESCAPED_BY);
    }
}
