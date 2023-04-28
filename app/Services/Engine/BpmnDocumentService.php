<?php

namespace App\Services\Engine;

use App\Models\Lottery;
use Illuminate\Validation\ValidationException;
use ProcessMaker\Nayra\Storage\BpmnDocument;
use ProcessMaker\Nayra\Storage\BpmnElement;

class BpmnDocumentService extends BpmnDocument
{
    /**
     * @param BpmnElement $element
     * @return array
     */
    public function attributes(BpmnElement $element): array
    {
        $startAttributes = collect();

        $extensionElements = $element->getElementsByTagNameNS('*', 'extensionElements');

        foreach ($extensionElements as $extensionElement) {
            // 获取 properties
            $properties = $extensionElement->getElementsByTagNameNS('*', 'property');
            foreach ($properties as $property) {
                // 获取属性
                foreach ($property->attributes as $attribute) {
                    $startAttributes->push([$attribute->name => $attribute->value]);
                }
            }
        }

        return $startAttributes->reduce(function ($carry, $item) {
            if (isset($item['name'])) {
                $carry[$item['name']] = null;
            } elseif (isset($item['value']) && is_array($carry) && count($carry) > 0) {
                $lastKey         = key(array_slice($carry, -1, 1, true));
                $carry[$lastKey] = $item['value'];
            }
            return $carry;
        }, []);
    }

    /**
     * @return bool|array
     * @throws \Illuminate\Validation\ValidationException|\Throwable
     */
    public function validate(): bool|array
    {
        /**
         * @var BpmnElement $rootElement
         */
        $rootElement = $this->getElementsByTagNameNS('*', 'process')->item(0);

        throw_if(is_null($rootElement), ValidationException::withMessages(['process' => '流程图中没有 process 标签',]));

        /**
         * @var BpmnElement $startEvent
         */
        $startEvent = $this->getElementsByTagName('startEvent')->item(0);

        throw_if(is_null($startEvent), ValidationException::withMessages(['startEvent' => '流程图中没有 startEvent 标签',]));

        $attributes = $this->attributes($startEvent);

        $attributes['name']         = $rootElement->getAttribute('name');
        $attributes['isExecutable'] = $rootElement->getAttribute('isExecutable') == 'true';

        validator($attributes, [
            'name'             => 'required',
            'isExecutable'     => 'required|boolean',
            'lottery_id'       => 'required',
            'lottery_option'   => 'required',
            'base_bet_amount'  => 'required|integer',
            'total_bet_amount' => 'required|integer',
        ])->validate();

        $lottery = Lottery::findOrFail($attributes['lottery_id']);
        throw_if(!$lottery->status, ValidationException::withMessages(['lottery_id' => '彩种未开启']));

        return $attributes;
    }

}
