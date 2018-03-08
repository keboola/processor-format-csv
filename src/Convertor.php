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

    /** @var string */
    private $escapedByFrom;

    /** @var string */
    private $escapedByTo;

    public function __construct(
        string $delimiterFrom,
        string $delimiterTo,
        string $enclosureFrom,
        string $enclosureTo,
        string $escapedByFrom,
        string $escapedByTo
    ) {
        $this->delimiterFrom = $delimiterFrom;
        $this->delimiterTo = $delimiterTo;
        $this->enclosureFrom = $enclosureFrom;
        $this->enclosureTo = $enclosureTo;
        $this->escapedByFrom = $escapedByFrom;
        $this->escapedByTo = $escapedByTo;
    }

    public function convertFile(string $filenameFrom, string $filenameTo): void
    {
        $csvFrom = new CsvFile(
            $filenameFrom,
            $this->delimiterFrom,
            $this->enclosureFrom,
            $this->escapedByFrom
        );
        $csvTo = new CsvFile(
            $filenameTo,
            $this->delimiterTo,
            $this->enclosureTo,
            $this->escapedByTo
        );

        foreach ($csvFrom as $row) {
            $csvTo->writeRow($row);
        }
    }
}
