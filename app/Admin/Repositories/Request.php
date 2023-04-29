<?php

namespace App\Admin\Repositories;

use App\Models\Request as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Request extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
