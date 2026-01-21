<?php

use Huluti\BreadcrumbsBundle\Test\DummyTranslator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    // Framework configuration
    $container->extension('framework', [
        'secret' => 'secret',
        'test' => true,
        'router' => [
            'resource' => null,
        ],
    ]);

    // Services
    $services = $container->services();

    $services
        ->set('translator', DummyTranslator::class)
        ->public()
    ;
};
