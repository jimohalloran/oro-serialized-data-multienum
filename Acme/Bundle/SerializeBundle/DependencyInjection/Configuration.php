<?php
/**
 *
 *
 * @package    wing-crm
 * @author     Jim O'Halloran <jim.ohalloran@incore.com.au>
 * @copyright  (c) 2019 InCore
 */


namespace Acme\Bundle\SerializeBundle\DependencyInjection;

use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function getConfigTreeBuilder(): \Symfony\Component\Config\Definition\Builder\TreeBuilder
    {
        $treeBuilder = new TreeBuilder('acme_serialize');
        $rootNode = $treeBuilder->getRootNode();
        SettingsBuilder::append($rootNode, [
//            'webhook_username' => [
//                'value' => '',
//            ],
        ]);
        return $treeBuilder;
    }
}
