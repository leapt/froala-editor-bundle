<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\DependencyInjection;

use Leapt\FroalaEditorBundle\Utility\UConfiguration;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class LeaptFroalaEditorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $arrConfig = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.php');

        $this->loadConfig($container, $arrConfig);
    }

    private function loadConfig(ContainerBuilder $container, array $arrConfig): void
    {
        // Load defined options in config file.
        foreach (UConfiguration::getArrOptionAll() as $option) {
            if (false === empty($arrConfig[$option])
                || false === $arrConfig[$option]
                || 0 === $arrConfig[$option]
            ) {
                $container->setParameter(Configuration::NODE_ROOT . '.' . $option, $arrConfig[$option]);
            }
        }

        $parameterProfiles = [];

        foreach ($arrConfig['profiles'] as $key => $profile) {
            $parameterProfiles[$key] = [];
            foreach ($profile as $optionKey => $optionValue) {
                if (false === empty($optionValue)
                    || false === $optionValue
                    || 0 === $optionValue
                ) {
                    $parameterProfiles[$key][$optionKey] = $optionValue;
                }
            }
        }

        $container->setParameter(Configuration::NODE_ROOT . '.profiles', $parameterProfiles);
    }
}
