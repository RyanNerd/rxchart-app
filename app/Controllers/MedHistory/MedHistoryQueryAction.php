<?php
declare(strict_types=1);

namespace Willow\Controllers\MedHistory;

use Willow\Controllers\QueryActionBase;
use Willow\Models\MedHistory;

class MedHistoryQueryAction extends QueryActionBase
{
    /**
     * @var MedHistory
     */
    protected $model;

    protected $orderBy = ['Created' => 'desc'];

    protected $allowAll = true;

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param MedHistory $model
     */
    public function __construct(MedHistory $model)
    {
        $this->model = $model;
    }
}