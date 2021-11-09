<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Service;

use Symfony\Component\Routing\RouterInterface;

final class OptionManager
{
    public function __construct(private RouterInterface $router)
    {
    }

    /**
     * Prepare options before building view.
     */
    public function prepareOptions(array &$options): void
    {
        $this->formatOptions($options);
        $this->generateRoutes($options);
        $this->addImageCustomParams($options);
        $this->addFileCustomParams($options);
        $this->addVideoCustomParams($options);
    }

    /**
     * Format some options.
     */
    private function formatOptions(array &$options): void
    {
        $basePath = $options['basePath'];
        $imageUploadFolder = $options['imageUploadFolder'];
        $fileUploadFolder = $options['fileUploadFolder'];
        $videoUploadFolder = $options['videoUploadFolder'];

        $options['basePath'] = trim($basePath, '/') . '/';
        $options['imageUploadFolder'] = trim($imageUploadFolder, '/') . '/';
        $options['fileUploadFolder'] = trim($fileUploadFolder, '/') . '/';
        $options['videoUploadFolder'] = trim($videoUploadFolder, '/') . '/';

        // Image folder and path.
        if (false === isset($options['imageUploadPath'])) {
            $options['imageUploadPath'] = $options['imageUploadFolder'];
        } else {
            $options['imageUploadPath'] = trim($options['imageUploadPath'], '/') . '/';
        }

        // File folder and path.
        if (false === isset($options['fileUploadPath'])) {
            $options['fileUploadPath'] = $options['fileUploadFolder'];
        } else {
            $options['fileUploadPath'] = trim($options['fileUploadPath'], '/') . '/';
        }

        // Video folder and path.
        if (false === isset($options['videoUploadPath'])) {
            $options['videoUploadPath'] = $options['videoUploadFolder'];
        } else {
            $options['videoUploadPath'] = trim($options['videoUploadPath'], '/') . '/';
        }

        // Custom JS.
        if (isset($options['customJS'])) {
            $options['customJS'] = trim($options['customJS'], '/');
        }
    }

    /**
     * Convert some route to URL.
     */
    private function generateRoutes(array &$options): void
    {
        // Manage user entries, image has default values (can be set to null by user), but save and parameters has no default values.
        $imageManagerDeleteURL = $options['imageManagerDeleteURL'] ?? null;
        $imageManagerLoadURL = $options['imageManagerLoadURL'] ?? null;
        $imageUploadURL = $options['imageUploadURL'] ?? null;
        $fileUploadURL = $options['fileUploadURL'] ?? null;
        $videoUploadURL = $options['videoUploadURL'] ?? null;

        $saveURL = $options['saveURL'] ?? null;
        $imageManagerDeleteURLParams = $options['imageManagerDeleteURLParams'] ?? [];
        $imageManagerLoadURLParams = $options['imageManagerLoadURLParams'] ?? [];
        $imageUploadURLParams = $options['imageUploadURLParams'] ?? [];
        $saveURLParams = $options['saveURLParams'] ?? [];
        $fileUploadURLParams = $options['fileUploadURLParams'] ?? [];
        $videoUploadURLParams = $options['videoUploadURLParams'] ?? [];

        if (null !== $imageManagerDeleteURL) {
            $options['imageManagerDeleteURL'] = $this->router->generate($imageManagerDeleteURL, $imageManagerDeleteURLParams);
        }

        if (null !== $imageManagerLoadURL) {
            $options['imageManagerLoadURL'] = $this->router->generate($imageManagerLoadURL, $imageManagerLoadURLParams);
        }

        if (null !== $imageUploadURL) {
            $options['imageUploadURL'] = $this->router->generate($imageUploadURL, $imageUploadURLParams);
        }

        if (null !== $saveURL) {
            $options['saveURL'] = $this->router->generate($saveURL, $saveURLParams);
        }

        if (null !== $fileUploadURL) {
            $options['fileUploadURL'] = $this->router->generate($fileUploadURL, $fileUploadURLParams);
        }

        if (null !== $videoUploadURL) {
            $options['videoUploadURL'] = $this->router->generate($videoUploadURL, $videoUploadURLParams);
        }
    }

    private function addImageCustomParams(array &$options): void
    {
        $imageUploadParams = $options['imageUploadParams'] ?? [];
        $imageManagerLoadParams = $options['imageManagerLoadParams'] ?? [];
        $imageManagerDeleteParams = $options['imageManagerDeleteParams'] ?? [];
        $arrCustomParams = ['folder' => $options['imageUploadFolder'], 'path' => $options['imageUploadPath'], 'public_dir' => $options['publicDir']];

        // Always adding these params breaks s3 signing in some cases
        if (!\array_key_exists('imageUploadToS3', $options)) {
            $options['imageUploadParams'] = array_merge($imageUploadParams, $arrCustomParams);
        }
        $options['imageManagerLoadParams'] = array_merge($imageManagerLoadParams, $arrCustomParams);
        $options['imageManagerDeleteParams'] = array_merge($imageManagerDeleteParams, $arrCustomParams);
    }

    private function addFileCustomParams(array &$options): void
    {
        $fileUploadParams = $options['fileUploadParams'] ?? [];
        $arrCustomParams = ['folder' => $options['fileUploadFolder'], 'path' => $options['fileUploadPath'], 'public_dir' => $options['publicDir']];

        $options['fileUploadParams'] = array_merge($fileUploadParams, $arrCustomParams);
    }

    private function addVideoCustomParams(array &$options): void
    {
        $videoUploadParams = $options['videoUploadParams'] ?? [];
        $arrCustomParams = ['folder' => $options['videoUploadFolder'], 'path' => $options['videoUploadPath'], 'public_dir' => $options['publicDir']];

        $options['videoUploadParams'] = array_merge($videoUploadParams, $arrCustomParams);
    }
}
