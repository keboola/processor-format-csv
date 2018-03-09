<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Exception;
use Keboola\Component\BaseComponent;
use Symfony\Component\Finder\Finder;
use function str_replace;

class Component extends BaseComponent
{
    public function run(): void
    {
        /** @var Config $config */
        $config = $this->getConfig();


        $tablesFinder = new Finder();
        $tablesFinder
            ->in($this->getDataDir() . "/in/tables")
            ->files();

        foreach ($tablesFinder as $csvTableFrom) {
            $convertor->convertFile(
                $csvTableFrom->getPathname(),
                $this->getTargetFilename($csvTableFrom->getPathname())
            );
        }
    }

    protected function getConfigDefinitionClass(): string
    {
        return ConfigDefinition::class;
    }

    protected function getConfigClass(): string
    {
        return Config::class;
    }

    private function getTargetFilename(string $sourceFile): string
    {
        $inPrefix = $this->getDataDir() . '/in/';
        $outPrefix = $this->getDataDir() . '/out/';
        if (strpos($sourceFile, $inPrefix) !== 0) {
            throw new Exception(sprintf(
                'Path of source file "%s" is expected to start with "%s"',
                $sourceFile,
                $inPrefix
            ));
        }
        return str_replace($inPrefix, $outPrefix, $sourceFile);
    }
}
