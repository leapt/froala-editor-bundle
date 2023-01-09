<?php

declare(strict_types=1);

namespace Leapt\FroalaEditorBundle\Controller;

use Leapt\FroalaEditorBundle\Service\MediaManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class MediaController
{
    public function __construct(private MediaManager $mediaManager, private KernelInterface $kernel)
    {
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $path = $request->request->get('path', '');
        $folder = $request->request->get('folder', '');
        $rootDir = $this->kernel->getProjectDir();
        $publicDir = $request->request->get('public_dir', '');
        $basePath = $request->getBasePath();

        return $this->mediaManager->uploadImage($request->files, $rootDir, $publicDir, $basePath, $folder, $path);
    }

    public function deleteImage(Request $request): Response
    {
        $imageSrc = urldecode($request->request->get('src'));
        $folder = urldecode($request->request->get('folder'));
        $rootDir = $this->kernel->getProjectDir();
        $publicDir = urldecode($request->request->get('public_dir'));

        $this->mediaManager->deleteImage($imageSrc, $rootDir, $publicDir, $folder);

        return new Response();
    }

    public function loadImages(Request $request): JsonResponse
    {
        $path = $request->query->get('path');
        $folder = $request->query->get('folder');
        $rootDir = $this->kernel->getProjectDir();
        $publicDir = $request->query->get('public_dir');
        $basePath = $request->getBasePath();

        return $this->mediaManager->loadImages($rootDir, $publicDir, $basePath, $folder, $path);
    }

    public function uploadFile(Request $request): JsonResponse
    {
        $path = $request->request->get('path', '');
        $folder = $request->request->get('folder', '');
        $rootDir = $this->kernel->getProjectDir();
        $publicDir = $request->request->get('public_dir', '');
        $basePath = $request->getBasePath();

        return $this->mediaManager->uploadFile($request->files, $rootDir, $publicDir, $basePath, $folder, $path);
    }

    public function uploadVideo(Request $request): JsonResponse
    {
        $path = $request->request->get('path', '');
        $folder = $request->request->get('folder', '');
        $rootDir = $this->kernel->getProjectDir();
        $publicDir = $request->request->get('public_dir', '');
        $basePath = $request->getBasePath();

        return $this->mediaManager->uploadVideo($request->files, $rootDir, $publicDir, $basePath, $folder, $path);
    }
}
