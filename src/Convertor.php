<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Keboola\Csv\CsvFile;

class Convertor
{
    /** @var string */
    private $delimiterFrom;

    /** @var string */
    private $delimiterTo;

    /** @var string */
    private $enclosureFrom;

    /** @var string */
    private $enclosureTo;

    public function __construct(
        string $delimiterFrom,
        string $delimiterTo,
        string $enclosureFrom,
        string $enclosureTo
    ) {
        $this->delimiterFrom = $delimiterFrom;
        $this->delimiterTo = $delimiterTo;
        $this->enclosureFrom = $enclosureFrom;
        $this->enclosureTo = $enclosureTo;
    }

    public function convertFile(string $filenameFrom, string $filenameTo): void
    {
        $csvFrom = new CsvFile(
            $filenameFrom,
            $this->delimiterFrom,
            $this->enclosureFrom
        );
        $csvTo = new CsvFile(
            $filenameTo,
            $this->delimiterTo,
            $this->enclosureTo
        );

        foreach ($csvFrom as $row) {
            $csvTo->writeRow($row);
        }
    }
}
