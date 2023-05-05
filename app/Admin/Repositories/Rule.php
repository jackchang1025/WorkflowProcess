<?php

namespace App\Admin\Repositories;

use App\Models\Rule as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Rule extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
