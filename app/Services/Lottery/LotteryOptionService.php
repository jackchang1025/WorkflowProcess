<?php


namespace App\Services\Lottery;


use App\Models\LotteryOption;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LotteryOptionService extends BaseService
{
    protected string $code;

    /**
     * LotteryOptionBiz constructor.
     */
    public function __construct(LotteryOption $lotteryOption)
    {
        $this->model = $lotteryOption;
    }

    /**
     * @param string $code
     * @param string $rule
     * @return bool|false
     */
    public function validateLotteryOptionValue(string $code,string $rule): bool
    {
        $validator = Validator::make(['code' => $code], ['code' => $rule]);

        return $validator->passes();
    }

    /**
     * 递归匹配彩票选项，子字节继承父节点使用正在表达式处理过的数据，父节点 ==>...=>子节点=>返回匹配的子节点模型
     * @param LotteryOption $option
     * @param string $code
     * @return bool
     */
    public function validateOptionWithParents(LotteryOption $option, string $code): bool
    {
        return !($option->parentNode && !$this->validateOptionWithParents($option->parentNode, $code)) && $this->validateLotteryOptionValue($option, $code);
    }

    /**
     * @param Collection $lotteryOption
     * @param string $code
     * @return Collection
     */
    public function validateLotteryOption(Collection $lotteryOption, string $code): Collection
    {
        return $lotteryOption->filter(function (LotteryOption $item) use ($code) {
            return $this->validateOptionWithParents($item, $code);
        });
    }
}
