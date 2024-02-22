<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Utility;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;

final class UConfiguration
{
    public const OPTIONS_BOOLEAN = [
        'attribution'                    => null,
        'autofocus'                      => null,
        'autoStart'                      => null,
        'charCounterCount'               => null,
        'codeBeautifier'                 => null,
        'codeMirror'                     => null,
        'colorsHEXInput'                 => null,
        'disableRightClick'              => null,
        'documentReady'                  => null,
        'dragInline'                     => null,
        'editInPopup'                    => null,
        'editorClass'                    => null,
        'emoticonsUseImage'              => null,
        'fileUpload'                     => null,
        'fileUseSelectedText'            => null,
        'fontFamilySelection'            => null,
        'fontSizeSelection'              => null,
        'formMultipleStyles'             => null,
        'fullPage'                       => null,
        'htmlAllowComments'              => null,
        'htmlExecuteScripts'             => null,
        'htmlSimpleAmpersand'            => null,
        'htmlUntouched'                  => null,
        'iframe'                         => null,
        'imageAddNewLine'                => null,
        'imageManagerToggleTags'         => null,
        'imageMove'                      => null,
        'imageMultipleStyles'            => null,
        'imagePaste'                     => null,
        'imageResize'                    => null,
        'imageResizeWithPercent'         => null,
        'imageRoundPercent'              => null,
        'imageSplitHTML'                 => null,
        'imageTextNear'                  => null,
        'imageUpload'                    => null,
        'imageUploadRemoteUrls'          => null,
        'imageOutputSize'                => null,
        'imagePasteProcess'              => null,
        'initOnClick'                    => null,
        'keepFormatOnDelete'             => null,
        'linkAlwaysBlank'                => null,
        'linkAlwaysNoFollow'             => null,
        'linkConvertEmailAddress'        => null,
        'linkMultipleStyles'             => null,
        'linkNoOpener'                   => null,
        'linkNoReferrer'                 => null,
        'linkText'                       => null,
        'listAdvancedTypes'              => null,
        'multiLine'                      => null,
        'paragraphDefaultSelection'      => null,
        'paragraphFormatSelection'       => null,
        'paragraphMultipleStyles'        => null,
        'pasteAllowLocalImages'          => null,
        'pastePlain'                     => null,
        'quickInsertEnabled'             => null,
        'requestWithCredentials'         => null,
        'requestWithCORS'                => null,
        'shortcutsHint'                  => null,
        'showChangesEnabled'             => null,
        'spellcheck'                     => null,
        'tableCellMultipleStyles'        => null,
        'tableInsertHelper'              => null,
        'tableMultipleStyles'            => null,
        'tableResizer'                   => null,
        'toolbarBottom'                  => null,
        'toolbarContainer'               => null,
        'toolbarInline'                  => null,
        'toolbarSticky'                  => null,
        'toolbarVisibleWithoutSelection' => null,
        'tooltips'                       => null,
        'trackChangesEnabled'            => null,
        'useClasses'                     => null,
        'videoMove'                      => null,
        'videoResize'                    => null,
        'videoResponsive'                => null,
        'videoSplitHTML'                 => null,
        'videoTextNear'                  => null,
        'videoUpload'                    => null,
        'wordPasteKeepFormatting'        => null,
        'wordPasteModal'                 => null,
    ];

    public const OPTIONS_BOOLEAN_CUSTOM = [
        'includeJS'          => true,
        'includeCSS'         => true,
        'includeFontAwesome' => true,
        'includeCodeMirror'  => true,
    ];

    public const OPTIONS_INTEGER = [
        'charCounterMax'              => null,
        'colorsStep'                  => null,
        'emoticonsStep'               => null,
        'fileMaxSize'                 => null,
        'filesManagerMaxSize'         => null,
        'height'                      => null,
        'heightMax'                   => null,
        'heightMin'                   => null,
        'imageDefaultMargin'          => null,
        'imageDefaultWidth'           => null,
        'imageManagerPageSize'        => null,
        'imageManagerScrollOffset'    => null,
        'imageMaxSize'                => null,
        'imageMinWidth'               => null,
        'indentMargin'                => null,
        'lineBreakerHorizontalOffset' => null,
        'lineBreakerOffset'           => null,
        'saveInterval'                => null,
        'tabIndex'                    => null,
        'tabSpaces'                   => null,
        'tableColorsStep'             => null,
        'tableInsertHelperOffset'     => null,
        'tableInsertMaxSize'          => null,
        'tableResizerOffset'          => null,
        'tableResizingLimit'          => null,
        'toolbarStickyOffset'         => null,
        'typingTimer'                 => null,
        'videoDefaultWidth'           => null,
        'videoMaxSize'                => null,
        'zIndex'                      => null,
    ];

    public const OPTIONS_STRING = [
        'apiKey'                        => null,
        'app'                           => null,
        'aviaryKey'                     => null,
        'colorsDefaultTab'              => null,
        'direction'                     => null,
        'docId'                         => null,
        'embedlyKey'                    => null,
        'embedlyScriptPath'             => null,
        'enter'                         => null,
        'entities'                      => null,
        'fileUploadMethod'              => null,
        'fileUploadParam'               => null,
        'fileUploadURL'                 => 'leapt_froala_editor_upload_file',
        'filesManagerUploadURL'         => null,
        'fontAwesomeTemplate'           => null,
        'fontFamilyDefaultSelection'    => null,
        'fontSizeDefaultSelection'      => null,
        'fontSizeUnit'                  => null,
        'iconsTemplate'                 => null,
        'iframeDefaultStyle'            => null,
        'iframeStyle'                   => null,
        'imageCORSProxy'                => null,
        'imageDefaultAlign'             => null,
        'imageDefaultDisplay'           => null,
        'imageManagerDeleteMethod'      => null,
        'imageManagerDeleteURL'         => 'leapt_froala_editor_delete_image',
        'imageManagerLoadMethod'        => null,
        'imageManagerLoadURL'           => 'leapt_froala_editor_load_images',
        'imageManagerPreloader'         => null,
        'imageUploadMethod'             => null,
        'imageUploadParam'              => null,
        'imageUploadURL'                => 'leapt_froala_editor_upload_image',
        'language'                      => null,
        'linkAutoPrefix'                => null,
        'placeholderText'               => null,
        'saveMethod'                    => null,
        'saveParam'                     => null,
        'saveURL'                       => null,
        'scaytCustomerId'               => null,
        'scrollableContainer'           => null,
        'tableDefaultWidth'             => null,
        'theme'                         => null,
        'username'                      => null,
        'videoDefaultAlign'             => null,
        'videoDefaultDisplay'           => null,
        'videoUploadMethod'             => null,
        'videoUploadParam'              => null,
        'videoUploadURL'                => 'leapt_froala_editor_upload_video',
        'width'                         => null,
    ];

    public const OPTIONS_STRING_CUSTOM = [
        'customJS'          => null,
        'basePath'          => '/bundles/leaptfroalaeditor/froala_editor',
        'imageUploadFolder' => '/upload',
        'imageUploadPath'   => null,
        'fileUploadFolder'  => '/upload',
        'fileUploadPath'    => null,
        'serialNumber'      => null,
        'videoUploadFolder' => '/upload',
        'videoUploadPath'   => null,
        'publicDir'         => '/public',
    ];

    public const OPTIONS_ARRAY = [
        'codeViewKeepActiveButtons' => [],
        'colorsBackground'          => [],
        'colorsButtons'             => [],
        'colorsText'                => [],
        'embedlyEditButtons'        => [],
        'embedlyInsertButtons'      => [],
        'emoticonsSet'              => [],
        'emoticonsButtons'          => [],
        'faButtons'                 => [],
        'fileAllowedTypes'          => [],
        'fileInsertButtons'         => [],
        'filesManagerAllowedTypes'  => [],
        'fontAwesomeSets'           => [],
        'fontAwesome5Sets'          => [],
        'fontSize'                  => [],
        'formEditButtons'           => [],
        'formUpdateButtons'         => [],
        'htmlAllowedAttrs'          => [],
        'htmlAllowedEmptyTags'      => [],
        'htmlAllowedStyleProps'     => [],
        'htmlAllowedTags'           => [],
        'htmlIgnoreCSSProperties'   => [],
        'htmlDoNotWrapTags'         => [],
        'htmlRemoveTags'            => [],
        'iframeStyleFiles'          => [],
        'imageAllowedTypes'         => [],
        'imageAltButtons'           => [],
        'imageEditButtons'          => [],
        'imageInsertButtons'        => [],
        'imageSizeButtons'          => [],
        'lineBreakerTags'           => [],
        'linkEditButtons'           => [],
        'linkInsertButtons'         => [],
        'linkList'                  => [],
        'pasteAllowedStyleProps'    => [],
        'pasteDeniedAttrs'          => [],
        'pasteDeniedTags'           => [],
        'pluginsEnabled'            => [],
        'quickInsertButtons'        => [],
        'quickInsertTags'           => [],
        'shortcutsEnabled'          => [],
        'specialCharButtons'        => [],
        'tableColors'               => [],
        'tableColorsButtons'        => [],
        'tableEditButtons'          => [],
        'tableInsertButtons'        => [],
        'toolbarButtons'            => [],
        'toolbarButtonsMD'          => [],
        'toolbarButtonsSM'          => [],
        'toolbarButtonsXS'          => [],
        'videoAllowedProviders'     => [],
        'videoAllowedTypes'         => [],
        'videoEditButtons'          => [],
        'videoInsertButtons'        => [],
        'videoSizeButtons'          => [],
        'wordAllowedStyleProps'     => [],
        'wordDeniedAttrs'           => [],
        'wordDeniedTags'            => [],
    ];

    public const OPTIONS_ARRAY_CUSTOM = [
        'pluginsDisabled' => [],
        'events'          => [],
    ];

    public const OPTIONS_OBJECT = [
        'aviaryOptions'            => [],
        'codeMirrorOptions'        => [],
        'codeBeautifierOptions'    => [],
        'codoxOptions'             => [],
        'fileUploadParams'         => [],
        'filesManagerUploadParams' => [],
        'fileUploadToS3'           => [],
        'filesManagerUploadToS3'   => [],
        'fontFamily'               => [],
        'formStyles'               => [],
        'googleOptions'            => [],
        'helpSets'                 => [],
        'imageManagerDeleteParams' => [],
        'imageManagerLoadParams'   => [],
        'imageStyles'              => [],
        'imageTUIOptions'          => [],
        'imageUploadParams'        => [],
        'imageUploadToS3'          => [],
        'inlineClasses'            => [],
        'inlineStyles'             => [],
        'lineHeights'              => [],
        'linkAttributes'           => [],
        'linkStyles'               => [],
        'paragraphFormat'          => [],
        'paragraphStyles'          => [],
        'requestHeaders'           => [],
        'saveParams'               => [],
        'scaytOptions'             => [],
        'specialCharactersSets'    => [],
        'tableStyles'              => [],
        'tableCellStyles'          => [],
        'videoUploadParams'        => [],
        'videoUploadToS3'          => [],
    ];

    public const OPTIONS_OBJECT_CUSTOM = [
        'imageManagerDeleteURLParams' => [],
        'imageManagerLoadURLParams'   => [],
        'imageUploadURLParams'        => [],
        'saveURLParams'               => [],
        'fileUploadURLParams'         => [],
        'videoUploadURLParams'        => [],
    ];

    public static function getArrOptionAll(): array
    {
        return array_merge(self::getArrOption(), self::getArrOptionCustom());
    }

    public static function getArrOption(): array
    {
        return array_merge(array_merge(
            array_merge(
                array_merge(
                    array_keys(self::OPTIONS_BOOLEAN),
                    array_keys(self::OPTIONS_INTEGER)),
                array_keys(self::OPTIONS_STRING)),
            array_keys(self::OPTIONS_ARRAY)),
            array_keys(self::OPTIONS_OBJECT));
    }

    public static function getArrOptionCustom(): array
    {
        return array_merge(array_merge(
            array_merge(
                array_keys(self::OPTIONS_BOOLEAN_CUSTOM),
                array_keys(self::OPTIONS_STRING_CUSTOM)),
            array_keys(self::OPTIONS_ARRAY_CUSTOM)),
            array_keys(self::OPTIONS_OBJECT_CUSTOM));
    }

    public static function addArrOptionBoolean(NodeBuilder $nodeBuilder, bool $addDefaultValue = true): void
    {
        $array = array_merge(self::OPTIONS_BOOLEAN, self::OPTIONS_BOOLEAN_CUSTOM);

        foreach ($array as $option => $defaultValue) {
            $nodeBuilder = $nodeBuilder->booleanNode($option);
            if ($addDefaultValue) {
                $nodeBuilder->defaultValue($defaultValue);
            }

            $nodeBuilder = $nodeBuilder->end();
        }
    }

    public static function addArrOptionInteger(NodeBuilder $nodeBuilder, bool $addDefaultValue = true): void
    {
        foreach (self::OPTIONS_INTEGER as $option => $defaultValue) {
            $nodeBuilder = $nodeBuilder->integerNode($option);

            if ($addDefaultValue) {
                $nodeBuilder = $nodeBuilder->defaultValue($defaultValue);
            }

            $nodeBuilder = $nodeBuilder->end();
        }
    }

    public static function addArrOptionString(NodeBuilder $nodeBuilder, bool $addDefaultValue = true): void
    {
        $array = array_merge(self::OPTIONS_STRING, self::OPTIONS_STRING_CUSTOM);

        foreach ($array as $option => $defaultValue) {
            $nodeBuilder = $nodeBuilder->scalarNode($option);
            if ($addDefaultValue) {
                $nodeBuilder = $nodeBuilder->defaultValue($defaultValue);
            }
            $nodeBuilder = $nodeBuilder->end();
        }
    }

    public static function addArrOptionArray(NodeBuilder $nodeBuilder, bool $addDefaultValue = true): void
    {
        $array = array_merge(self::OPTIONS_ARRAY, self::OPTIONS_ARRAY_CUSTOM);

        foreach ($array as $option => $defaultValue) {
            $nodeBuilder =
                $nodeBuilder->arrayNode($option)->prototype('variable')->end();

            if ($addDefaultValue) {
                $nodeBuilder = $nodeBuilder->defaultValue($defaultValue);
            }

            $nodeBuilder = $nodeBuilder->end();
        }
    }

    public static function addArrOptionObject(NodeBuilder $nodeBuilder, bool $addDefaultValue = true): void
    {
        $array = array_merge(self::OPTIONS_OBJECT, self::OPTIONS_OBJECT_CUSTOM);

        foreach ($array as $option => $defaultValue) {
            $nodeBuilder =
                $nodeBuilder->arrayNode($option)->prototype('variable')->end();

            if ($addDefaultValue) {
                $nodeBuilder = $nodeBuilder->defaultValue($defaultValue);
            }

            $nodeBuilder = $nodeBuilder->end();
        }
    }
}
