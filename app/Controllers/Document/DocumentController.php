<?php
declare(strict_types=1);

namespace Willow\Controllers\Document;

use Slim\Interfaces\RouteCollectorProxyInterface;
use Willow\Controllers\IController;

class DocumentController implements IController
{
    /**
     * Register routes and actions
     * @param RouteCollectorProxyInterface $group
     */
    final public function register(RouteCollectorProxyInterface $group): void {
        $group->post('/document/upload/{client_id}', DocumentUploadAction::class)
            ->add(DocumentUploadValidator::class);

        $group->get('/document/{id}', DocumentGetAction::class);

        $group->post('/document', DocumentUpdateAction::class);
    }
}
