<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Keboola\Component\Config\BaseConfig;

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

    public function getDelimiterTo(): string
    {
        return $this->getValue(['parameters', 'delimiterTo']);
    }

    public function getEnclosureTo(): string
    {
        return $this->getValue(['parameters', 'enclosureTo']);
    }
}
