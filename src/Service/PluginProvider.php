<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Service;

use Symfony\Component\String\UnicodeString;

class PluginProvider
{
    public const KEY_CSS = 'css';
    public const KEY_FOLDER = 'folder';
    public const VALUE_PLUGINS = 'plugins';
    public const VALUE_THIRD_PARTY = 'third_party';

    /**
     * Can be easier but can handle further configurations.
     */
    private static $ARR_PLUGIN_CONFIG =
        [
            // Plugins.
            'align'               => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'char_counter'        => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'code_beautifier'     => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'code_view'           => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'colors'              => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'draggable'           => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'emoticons'           => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'entities'            => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'file'                => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'files_manager'       => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'font_family'         => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'font_size'           => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'fullscreen'          => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'help'                => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'image'               => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'image_manager'       => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'inline_class'        => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'inline_style'        => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'line_breaker'        => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'line_height'         => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'link'                => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'lists'               => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'paragraph_format'    => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'paragraph_style'     => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'print'               => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'quick_insert'        => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'quote'               => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'save'                => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'special_characters'  => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'table'               => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'url'                 => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'video'               => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_PLUGINS],
            'word_paste'          => [self::KEY_CSS => 0, self::KEY_FOLDER => self::VALUE_PLUGINS],

            // Third party.
            'embedly'             => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_THIRD_PARTY],
            'spell_checker'       => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_THIRD_PARTY],
            'font_awesome'        => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_THIRD_PARTY],
            'image_tui'           => [self::KEY_CSS => 1, self::KEY_FOLDER => self::VALUE_THIRD_PARTY],
        ];

    public function obtainArrPluginToInclude(array $enabledPlugins, array $disabledPlugins): array
    {
        $arrPluginName = array_keys(self::$ARR_PLUGIN_CONFIG);

        if (!empty($disabledPlugins)) {
            return array_diff($arrPluginName, $disabledPlugins);
        }

        if (!empty($enabledPlugins)) {
            return array_intersect($arrPluginName, $enabledPlugins);
        }

        return $arrPluginName;
    }

    /**
     * Obtains array of JS files to include (all have one).
     */
    public function obtainArrPluginJS(array $plugins): array
    {
        $arrPlugin = [];

        foreach ($plugins as $plugin) {
            $arrPlugin[] = $this->obtainConfiguration($plugin, self::KEY_FOLDER) . '/' . $plugin;
        }

        return $arrPlugin;
    }

    /**
     * Obtains array of CSS files to include (check in const).
     */
    public function obtainArrPluginCSS($plugins): array
    {
        $arrPlugin = [];

        foreach ($plugins as $plugin) {
            if ($this->obtainConfiguration($plugin, self::KEY_CSS) === 1) {
                $arrPlugin[] = $this->obtainConfiguration($plugin, self::KEY_FOLDER) . '/' . $plugin;
            }
        }

        return $arrPlugin;
    }

    /**
     * Obtains array of plugin to include (camelized).
     */
    public function obtainArrPluginCamelized(array $plugins): array
    {
        $arrPlugin = [];

        foreach ($plugins as $plugin) {
            $arrPlugin[] = (new UnicodeString($plugin))->camel()->toString();
        }

        return $arrPlugin;
    }

    private function obtainConfiguration(string $plugin, string $key)
    {
        return self::$ARR_PLUGIN_CONFIG[$plugin][$key];
    }
}
