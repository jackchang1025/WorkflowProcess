<?php

namespace App\Admin\Repositories;

use App\Models\Process as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Process extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
