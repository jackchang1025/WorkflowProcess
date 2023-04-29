<?php

namespace App\Admin\Repositories;

use App\Models\LotteryOption as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class LotteryOption extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
