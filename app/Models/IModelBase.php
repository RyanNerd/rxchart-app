<?php
declare(strict_types=1);

namespace Willow\Models;

interface IModelBase
{
    public function getTableName(): string;
}
