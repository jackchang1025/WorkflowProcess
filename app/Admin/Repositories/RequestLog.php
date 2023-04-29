<?php

namespace App\Admin\Repositories;

use App\Models\RequestLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RequestLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
