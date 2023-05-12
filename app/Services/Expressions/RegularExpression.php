<?php

namespace App\Services\Expressions;

use Illuminate\Support\Facades\Log;

class RegularExpression extends BaseExpression
{
    /**
     * @return array|bool
     */
    public function evaluate(): bool|array
    {
        try {

            return preg_match($this->expression, (string) $this->data, $matches) ? $matches : false;

        } catch (\Exception $e) {

            Log::channel('ondemand')->error($e->getMessage(), ['expression' => $this->expression, 'data' => $this->data->toArray()]);
            return false;
        }
    }

    /**
     * @return bool
     */
    public function isExpression(): bool
    {
        try {
            return preg_match($this->expression, '') !== false;

        } catch (\Exception) {

            return false;
        }
    }

}
