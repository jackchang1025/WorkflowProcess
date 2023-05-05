<?php

namespace App\Admin\Actions\Grid;

use App\Jobs\RequestJob;
use App\Models\Process;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RequestStatusRowAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = 'Stop Request';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $process = \App\Models\Request::where('id', $this->getKey())->first();
        if (!$process) {
            return $this->response()
                ->error('Request not found: ' . $this->getKey())
                ->refresh();
        }

        if (in_array($process->status, [\App\Models\Request::STATUS_PENDING, \App\Models\Request::STATUS_RUNNING])) {

            $process->status = \App\Models\Request::STATUS_STOP;
            $process->save();

            return $this->response()
                ->success('Request already stopped')
                ->refresh();
        }

        return $this->response()
            ->error('Request status ' . $process->status)
            ->refresh();
    }

    /**
     * @return array
     */
    public function confirm(): array
    {
        return ['Confirm?', 'contents'];
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [];
    }
}
