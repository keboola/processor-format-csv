<?php

declare(strict_types=1);

namespace Keboola\Processor\FormatCsv;

use Keboola\Component\Config\BaseConfigDefinition;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigDefinition extends BaseConfigDefinition
{
    public function getParametersDefinition(): ArrayNodeDefinition
    {
        $treeBuilder = new TreeBuilder();
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->root("parameters");
        // @formatter:off
        $rootNode
            ->children()
                ->scalarNode('delimiterFrom')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('enclosureFrom')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('escapedByFrom')
                ->end()
                ->scalarNode('delimiterTo')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('enclosureTo')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('escapedByTo')
                ->end()
            ->end()
        ;
        // @formatter:on
        return $rootNode;
    }
}
