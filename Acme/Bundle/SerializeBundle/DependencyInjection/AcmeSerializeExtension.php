<?php
/**
 *
 *
 * @package    wing-crm
 * @author     Jim O'Halloran <jim.ohalloran@incore.com.au>
 * @copyright  (c) 2019 InCore
 */


namespace Acme\Bundle\SerializeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Wing\Bundle\CommonBundle\DependencyInjection\Configuration;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AcmeSerializeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        //$loader->load('form.yml');
        $loader->load('controllers.yml');

        $container->prependExtensionConfig($this->getAlias(), array_intersect_key($config, array_flip(['settings'])));
    }
}
