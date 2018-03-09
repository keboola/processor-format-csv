<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Exception;
use InvalidArgumentException;
use Keboola\Component\BaseComponent;
use Keboola\Component\UserException;
use Symfony\Component\Finder\Finder;
use Throwable;
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
            try {
                $tableManifest = $this->getManifestManager()->getTableManifest($csvTableFrom->getFilename());
            } catch (InvalidArgumentException $e) {
                throw new UserException(
                    'This processor needs table manifest to work. Add a Create Manifest processor before it.',
                    0,
                    $e
                );
            }
            if (!isset($tableManifest['delimiter'], $tableManifest['enclosure'])) {
                throw new UserException('Table manifest must contain delimiter and enclosure.');
            }
            $convertor = new Convertor(
                $tableManifest['delimiter'],
                $config->getDelimiterTo(),
                $tableManifest['enclosure'],
                $config->getEnclosureTo()
            );
            $filenameTo = $this->getTargetFilename($csvTableFrom->getPathname());
            $convertor->convertFile(
                $csvTableFrom->getPathname(),
                $filenameTo
            );
            $this->getManifestManager()->writeTableManifestFromArray(
                $filenameTo,
                array_merge(
                    $tableManifest,
                    [
                        'delimiter' => $config->getDelimiterTo(),
                        'enclosure' => $config->getEnclosureTo(),
                    ]
                )
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
