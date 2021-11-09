<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Form\Type;

use Leapt\FroalaEditorBundle\DependencyInjection\Configuration;
use Leapt\FroalaEditorBundle\Service\OptionManager;
use Leapt\FroalaEditorBundle\Service\PluginProvider;
use Leapt\FroalaEditorBundle\Utility\UConfiguration;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FroalaEditorType extends AbstractType
{
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;

    /**
     * @var OptionManager
     */
    private $optionManager;

    /**
     * @var PluginProvider
     */
    private $pluginProvider;

    public function __construct(ParameterBagInterface $parameterBag, OptionManager $optionManager, PluginProvider $pluginProvider)
    {
        $this->parameterBag = $parameterBag;
        $this->optionManager = $optionManager;
        $this->pluginProvider = $pluginProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        foreach ($options as $key => $option) {
            if (0 !== strpos($key, 'froala_')) {
                continue;
            }
            $builder->setAttribute($key, $option);
        }
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $options = array_filter($options, static function ($key) {
            return strpos($key, 'froala_') === 0;
        }, \ARRAY_FILTER_USE_KEY);

        $arrKey = UConfiguration::getArrOption();
        $arrKeyCustom = UConfiguration::getArrOptionCustom();
        $arrOption = [];
        $arrPluginEnabled = $options['froala_pluginsEnabled'] ?? [];
        $arrPluginDisabled = $options['froala_pluginsDisabled'] ?? [];
        $arrEvent = $options['froala_events'] ?? [];
        $profile = $options['froala_profile'] ?? null;

        if ($profile && $this->parameterBag->has(Configuration::$NODE_ROOT . '.profiles')) {
            $profiles = $this->parameterBag->get(Configuration::$NODE_ROOT . '.profiles');

            if (\array_key_exists($profile, $profiles)) {
                $profileConfig = $profiles[$profile];
                foreach ($profileConfig as $profileKey => $profileOption) {
                    $options['froala_' . $profileKey] = $profileOption;
                }
            } else {
                throw new \InvalidArgumentException(sprintf('Unrecognized profile "%s". Available profiles are "%s".', $profile, implode('"", "', array_keys($profiles))));
            }
        }

        $finalOptions = [];
        foreach ($options as $key => $value) {
            $finalOptions[substr($key, \strlen('froala_'))] = $value;
        }

        $this->optionManager->prepareOptions($finalOptions);

        // Separate Froala options from custom, to iterate properly in twig widget.
        foreach ($finalOptions as $key => $option) {
            if (\in_array($key, $arrKey, true)) {
                $arrOption[$key] = $option;
            } elseif (\in_array($key, $arrKeyCustom, true)) {
                $view->vars['froala_' . $key] = $option;
            }
        }

        $view->vars['froala_arrOption'] = $arrOption;

        $arrPlugin = $this->pluginProvider->obtainArrPluginToInclude($arrPluginEnabled, $arrPluginDisabled);

        $view->vars['froala_arrOption']['pluginsEnabled'] = $this->pluginProvider->obtainArrPluginCamelized($arrPlugin);
        $view->vars['froala_arrPluginJS'] = $this->pluginProvider->obtainArrPluginJS($arrPlugin);
        $view->vars['froala_arrPluginCSS'] = $this->pluginProvider->obtainArrPluginCSS($arrPlugin);
        $view->vars['froala_events'] = $arrEvent;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $arrDefault = [];
        $arrDefined = [];

        foreach (UConfiguration::getArrOptionAll() as $option) {
            $optionName = 'froala_' . $option;
            // If defined in config file, set default value to form, else set option as available.
            if ($this->parameterBag->has(Configuration::$NODE_ROOT . '.' . $option)) {
                $arrDefault[$optionName] = $this->parameterBag->get(Configuration::$NODE_ROOT . '.' . $option);
            } else {
                $arrDefined[] = $optionName;
            }
        }

        $arrDefined[] = 'froala_profile';
        $resolver->setDefined($arrDefined);
        $resolver->setDefaults($arrDefault);
    }

    public function getParent(): string
    {
        return TextareaType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'froala';
    }
}
