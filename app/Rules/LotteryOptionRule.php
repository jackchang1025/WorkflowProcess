<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class LotteryOptionRule implements Rule, DataAwareRule, ValidatorAwareRule
{
    protected array $data = [];

    protected string|array $search;

    protected string|array $replace;

    /**
     * 验证器实例。
     *
     * @var Validator
     */
    protected Validator $validator;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()//array|string $search , array|string $replace
    {
        // $this->search = $search;
        // $this->replace = $replace;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        dd($attribute, $value, $this->validator->getRules());

        $this->data[$attribute] = str_replace($this->search, $this->replace, $value);
        $this->validator->setData($this->data);
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    public function setData($data): LotteryOptionRule|static
    {
        $this->data = $data;
        return $this;
    }

    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function str_replace($attribute, $value, $parameters, $validator): bool
    {
        $search  = $parameters[0] ?? '';
        $search  = $search === '.' ? ',' : $search;
        $replace = $parameters[1] ?? '';
        $value   = str_replace($search, $replace, $value);

        return $this->resetData($attribute, $value, $validator);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function explode($attribute, $value, $parameters, $validator): bool
    {
        if (is_string($value) && $separator = $parameters[0] ?? '') {
            $separator = $separator === '.' ? ',' : $separator;
            $value     = explode($separator, $value);
        }
        return $this->resetData($attribute, $value, $validator);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function array_sum($attribute, $value, $parameters, $validator): bool
    {
        return !is_array($value) || $this->resetData($attribute, array_sum($value), $validator);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function substr($attribute, $value, $parameters, $validator): bool
    {
        return !is_string($value) || $this->resetData($attribute, Str::substr(
                $value,
                $parameters[0] ?? 0,
                $parameters[1] ?? null
            ), $validator);
    }

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return bool
     */
    public function pregMatch($attribute, $value, $parameters, $validator): bool
    {
        return $parameters[0] ?? '' ? preg_match($parameters[0], $value) : false;
    }

    /**
     * @param string $attribute
     * @param $value
     * @param Validator $validator
     * @return bool
     */
    public function resetData(string $attribute, $value, Validator $validator): bool
    {
        $data             = $validator->getData();
        $data[$attribute] = $value;
        $validator->setData($data);
        return true;
    }
}
