<?php
declare(strict_types=1);

namespace Willow\Controllers\Resident;

use Willow\Controllers\QueryActionBase;
use Willow\Models\Resident;

class ResidentQueryAction extends QueryActionBase
{
    /**
     * @var Resident
     */
    protected $model;

    protected $allowAll = true;

    protected $orderBy = ['LastName' => 'asc'];

    /**
     * Get the model via Dependency Injection and save it as a property.
     *
     * @param Resident $model
     */
    public function __construct(Resident $model)
    {
        $this->model = $model;
    }
}