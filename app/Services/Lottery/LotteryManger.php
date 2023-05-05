<?php

namespace App\Services\Lottery;

use App\Models\Request;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Manager;

/**
 * @method  Response issueLastOpenInfo()
 * @method  Response issueOpenInfo(int $issue)
 * @method static Response lotteryHistoryOpenInfo()
 * @method static Response lotteryBet(int $issue, string $betCode, float $betAmount)
 */
class LotteryManger extends Manager
{

    public function __construct(Container $container, array $config = [])
    {
        parent::__construct($container);

        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function getDefaultDriver(): string
    {
        return 'extremelyFastThree';
    }

    /**
     *
     * @return LotteryInterFace|ExtremelyFastThreeTestService|ExtremelyFastThreeService
     * @throws \Throwable
     */
    public function createExtremelyFastThreeDriver(): LotteryInterFace|ExtremelyFastThreeTestService|ExtremelyFastThreeService
    {
        if ($this->config['code_type'] == Request::CODE_TYPE_HISTORY) {
            return new ExtremelyFastThreeTestService(
                $this->config['url_address'],
                $this->config['token'],
                $this->config['lottery_id'],
                $this->config['version']
            );
        }
        return new ExtremelyFastThreeService(
            $this->config['url_address'],
            $this->config['token'],
            $this->config['lottery_id'],
            $this->config['version']
        );
    }
}
