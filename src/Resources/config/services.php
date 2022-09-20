<?php

declare(strict_types=1);

use Leapt\FroalaEditorBundle\Command\InstallCommand;
use Leapt\FroalaEditorBundle\Controller\MediaController;
use Leapt\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Leapt\FroalaEditorBundle\Service\MediaManager;
use Leapt\FroalaEditorBundle\Service\OptionManager;
use Leapt\FroalaEditorBundle\Service\PluginProvider;
use Leapt\FroalaEditorBundle\Twig\FroalaExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container): void {
    $container->services()
        // Commands
        ->set(InstallCommand::class)
            ->tag('console.command', ['command' => 'froala:install'])

        // Controllers
        ->set(MediaController::class)
            ->arg('$mediaManager', service('leapt_froala_editor.media_manager'))
            ->arg('$kernel', service('kernel'))
            ->public()

        // Form types
        ->set('leapt_froala_editor.form.type')
            ->class(FroalaEditorType::class)
            ->arg('$parameterBag', service('parameter_bag'))
            ->arg('$optionManager', service('leapt_froala_editor.option_manager'))
            ->arg('$pluginProvider', service('leapt_froala_editor.plugin_provider'))
            ->tag('form.type')

        // Managers/providers
        ->set('leapt_froala_editor.option_manager')
            ->class(OptionManager::class)
            ->arg('$router', service('router'))

        ->set('leapt_froala_editor.plugin_provider')
            ->class(PluginProvider::class)

        ->set('leapt_froala_editor.media_manager')
            ->class(MediaManager::class)
            ->public()

        // Twig extensions
        ->set('leapt_froala_editor.froala_extension')
            ->class(FroalaExtension::class)
            ->arg('$parameterBag', service('parameter_bag'))
            ->arg('$packages', service('assets.packages'))
            ->tag('twig.extension')
    ;
};
