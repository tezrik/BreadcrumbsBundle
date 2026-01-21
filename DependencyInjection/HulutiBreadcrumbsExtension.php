<?php

namespace Huluti\BreadcrumbsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class HulutiBreadcrumbsExtension extends Extension
{
    /**
     * Loads our service, accessible as "huluti_breadcrumbs".
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $this->loadConfiguration($configs, $container);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('breadcrumbs.php');
    }

    /**
     * Loads the configuration in, with any defaults.
     */
    protected function loadConfiguration(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('huluti_breadcrumbs.options', $config);
    }
}
