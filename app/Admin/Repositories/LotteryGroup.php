<?php

namespace App\Admin\Repositories;

use App\Models\LotteryGroup as Model;
use Dcat\Admin\Repositories\EloquentRepository;
use Dcat\Admin\Traits\ModelTree;

class LotteryGroup extends EloquentRepository
{



    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
