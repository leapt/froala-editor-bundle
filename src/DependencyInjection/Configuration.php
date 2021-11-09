<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\DependencyInjection;

use Leapt\FroalaEditorBundle\Utility\UConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const NODE_ROOT = 'leapt_froala_editor';

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::NODE_ROOT);
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        // Add all available configuration nodes.
        $nodeBuilder = $rootNode->addDefaultsIfNotSet()->children();
        $this->addFroalaConfigTree($nodeBuilder);

        // "profiles" are treated separately as they repeat main option structures
        /** @var ArrayNodeDefinition $profileSubTreeBuilder */
        $profileSubTreeBuilder = $nodeBuilder
            ->arrayNode('profiles')
            ->useAttributeAsKey('name')
            ->prototype('array');
        $childrenProfileSubTreeBuilder = $profileSubTreeBuilder->children();
        $this->addFroalaConfigTree($childrenProfileSubTreeBuilder, false);
        // End profiles' children node
        $profileSubTreeBuilder->end();
        // End profiles node
        $profileSubTreeBuilder->end();
        $nodeBuilder->end();

        return $treeBuilder;
    }

    /**
     * Add all options to configuration subtree.
     */
    private function addFroalaConfigTree(NodeBuilder $nodeBuilder, bool $addDefaultValue = true): void
    {
        UConfiguration::addArrOptionBoolean($nodeBuilder, $addDefaultValue);
        UConfiguration::addArrOptionInteger($nodeBuilder, $addDefaultValue);
        UConfiguration::addArrOptionString($nodeBuilder, $addDefaultValue);
        UConfiguration::addArrOptionArray($nodeBuilder, $addDefaultValue);
        UConfiguration::addArrOptionObject($nodeBuilder, $addDefaultValue);
    }
}
