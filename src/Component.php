<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Exception;
use Keboola\Component\BaseComponent;
use Keboola\Component\UserException;
use Symfony\Component\Finder\Finder;
use function str_replace;
use Throwable;

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
                if (!isset($tableManifest['delimiter'], $tableManifest['enclosure'])) {
                    throw new Exception('Table manifest must contain delimiter and enclosure.');
                }
            } catch (Throwable $e) {
                throw new UserException('This processor needs table manifest to work. Add a Create Manifest processor before it.', 0, $e);
            }
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
