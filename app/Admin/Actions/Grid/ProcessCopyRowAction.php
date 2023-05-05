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

class ProcessCopyRowAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = 'copy';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $process = Process::where('id', $this->getKey())->first();
        if (!$process) {
            return $this->response()
                ->error('Process not found: ' . $this->getKey())
                ->refresh();
        }

        $newProcess = $process->replicate();
        $newProcess->title = $newProcess->title . time().' copy';
        $newProcess->save();

        return $this->response()
            ->success('Processed successfully')->refresh();
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
