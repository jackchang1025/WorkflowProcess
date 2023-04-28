<?php

namespace App\Admin\Actions\Grid;

use App\Jobs\ProcessJob;
use App\Models\Process;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProcessDispatchRowAction extends RowAction
{
    /**
     * @return string
     */
	protected $title = 'ProcessDispatch';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $process = Process::where('id',$this->getKey())->first();
        if (!$process) {
            return $this->response()
                ->error('Process not found: '.$this->getKey())
                ->refresh();
        }
        if (!$process->status) {
            return $this->response()
                ->error('Process status error: '.$this->getKey())
                ->refresh();
        }

        ProcessJob::dispatchSync($process->id);

        return $this->response()
            ->success('Processed successfully');
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
