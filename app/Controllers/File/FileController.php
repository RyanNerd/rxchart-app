<?php
declare(strict_types=1);

namespace Willow\Controllers\File;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class FileController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/file/upload/{client_id}', FileUploadAction::class)
            ->add(FileUploadValidator::class);

        $group->get('/file/download/{id}', FileDownloadAction::class);

        $group->get('/file/{id}', FileGetAction::class);

        $group->post('/file', FileUpdateAction::class);

        $group->delete('/file/{id}', FileDeleteAction::class);

        $group->get('/file/load/{client_id}', FileLoadAction::class);
    }
}
