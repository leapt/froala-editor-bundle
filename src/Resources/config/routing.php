<?php

declare(strict_types=1);

use Leapt\FroalaEditorBundle\Controller\MediaController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routes): void {
    // Image upload
    $routes->add('leapt_froala_editor_upload_image', '/upload_image')
        ->controller([MediaController::class, 'uploadImage']);

    $routes->add('leapt_froala_editor_delete_image', '/delete_image')
        ->controller([MediaController::class, 'deleteImage']);

    $routes->add('leapt_froala_editor_load_images', '/load_images')
        ->controller([MediaController::class, 'loadImages']);

    // File upload
    $routes->add('leapt_froala_editor_upload_file', '/upload_file')
        ->controller([MediaController::class, 'uploadFile']);

    // Video upload
    $routes->add('leapt_froala_editor_upload_video', '/upload_video')
        ->controller([MediaController::class, 'uploadVideo']);
};
