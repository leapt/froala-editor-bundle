<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Service;

use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\JsonResponse;

class MediaManager
{
    public static $allowedImageFileExtensions = ['gif', 'jpeg', 'jpg', 'png'];
    public static $allowedImageFileMimeTypes = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'];

    public function uploadImage(FileBag $fileBag, string $rootDir, string $publicDir, string $basePath, string $configuredFolder, string $requestPath): JsonResponse
    {
        return $this->handleFileUpload($fileBag, $rootDir, $publicDir, $basePath, $configuredFolder, $requestPath, 'image');
    }

    public function deleteImage(string $imageSrc, string $rootDir, string $publicDir, string $configuredFolder): void
    {
        $folder = $this->obtainFolder($rootDir, $publicDir, $configuredFolder);
        $arrExploded = explode('/', $imageSrc);

        $fileName = $arrExploded[\count($arrExploded) - 1];
        unlink($folder . '/' . $fileName);
    }

    public function loadImages(string $rootDir, string $publicDir, string $basePath, string $configuredFolder, string $requestPath): JsonResponse
    {
        $response = new JsonResponse();
        $arrImage = [];
        $folder = $this->obtainFolder($rootDir, $publicDir, $configuredFolder);
        $path = $this->obtainPath($basePath, $requestPath);
        $finder = new Finder();

        $finder->files()->in($folder);

        foreach ($finder as $file) {
            if (!\in_array($file->getExtension(), static::$allowedImageFileExtensions, true)) {
                continue;
            }
            $arrImage[] = ['url' => $path . $file->getFilename(), 'thumb' => $path . $file->getFilename()];
        }

        $response->setData($arrImage);

        return $response;
    }

    public function uploadFile(FileBag $fileBag, string $rootDir, string $publicDir, string $basePath, string $configuredFolder, string $requestPath): JsonResponse
    {
        return $this->handleFileUpload($fileBag, $rootDir, $publicDir, $basePath, $configuredFolder, $requestPath);
    }

    public function uploadVideo(FileBag $fileBag, string $rootDir, string $publicDir, string $basePath, string $configuredFolder, string $requestPath): JsonResponse
    {
        return $this->handleFileUpload($fileBag, $rootDir, $publicDir, $basePath, $configuredFolder, $requestPath);
    }

    /**
     * Obtain the physical folder.
     */
    private function obtainFolder(string $rootDir, string $publicDir, string $folder): string
    {
        return sprintf('%s%s/%s', $rootDir, $publicDir, $folder);
    }

    private function obtainPath(string $basePath, string $path): string
    {
        return $basePath . '/' . $path;
    }

    private function handleFileUpload(FileBag $fileBag, string $rootDir, string $publicDir, string $basePath, string $configuredFolder, string $requestPath, ?string $specificType = null): JsonResponse
    {
        $folder = $this->obtainFolder($rootDir, $publicDir, $configuredFolder);
        $path = $this->obtainPath($basePath, $requestPath);
        $response = new JsonResponse();

        $file = $fileBag->get('file');
        if (null === $file) {
            $response->setData([
                'error' => 'No file received.',
            ]);

            return $response;
        }

        if ($file->getSize() > UploadedFile::getMaxFilesize()) {
            $response->setData([
                'error' => 'File too big.',
            ]);

            return $response;
        }

        // Check image type.
        if ('image' === $specificType && (!\in_array($file->guessExtension(), static::$allowedImageFileExtensions, true) || !\in_array($file->getMimeType(), static::$allowedImageFileMimeTypes, true))) {
            $response->setData([
                'error' => 'File not supported.',
            ]);

            return $response;
        }

        // Generates random name.
        $name = sha1(uniqid((string) mt_rand(), true)) . '.' . $file->guessExtension();

        // Save file in the folder.
        $file->move($folder, $name);

        $response->setData([
            'link' => $path . $name,
        ]);

        return $response;
    }
}
