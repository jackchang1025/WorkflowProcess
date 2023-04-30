<?php

namespace App\Services\Lottery;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class AbstractLotteryService
{

    /**
     * config
     * @var array
     */
    protected array $config;

    /**
     * url
     * @var string
     */
    protected string $urlAddress;

    /**
     * 此次尝试睡眠时间
     * @var int
     */
    protected int $sleepMilliseconds = 5000;

    /**
     * 当前期数信息
     * @var Response|array|null
     */
    protected Response|array|null $currentLottery = [];

    /**
     * 上一次期数信息
     * @var Response|array|null
     */
    protected Response|array|null $lastLottery = [];


    /**
     * @param string $urlAddress
     * @param string $token
     * @param int $lotteryId
     * @param string $version
     * @throws \Throwable
     */
    public function __construct(string $urlAddress, string $token, int $lotteryId, string $version = '1.0')
    {
        throw_unless($urlAddress, new Exception('urlAddress不能为空'));

        throw_unless($token, new Exception('token不能为空'));

        throw_unless($lotteryId, new Exception('lotteryId不能为空'));

        $this->config = [
            "lotteryId"  => $lotteryId,
            "clientType" => 1,
            "channel"    => "bg",
            "version"    => $version,
            "sn"         => "cp06",
            "token"      => $token
        ];

        $this->urlAddress = $urlAddress;
    }

    /**
     * @param array|Response $currentLottery
     */
    public function setCurrentLottery(array|Response $currentLottery = []): void
    {
        $this->currentLottery = $currentLottery;
    }

    /**
     * @return array|Response
     */
    public function getCurrentLottery(): array|Response
    {
        return $this->currentLottery;
    }

    /**
     * @param array|Response $lastLottery
     */
    public function setLastLottery(array|Response $lastLottery = []): void
    {
        $this->lastLottery = $lastLottery;
    }

    /**
     * @return array|Response
     */
    public function getLastLottery(): array|Response
    {
        return $this->lastLottery;
    }

    /**
     * 接口提交
     * @param string $cmd
     * @param int|null $issue
     * @return Response
     * @throws Exception
     */
    public function lotteryApi(string $cmd, int $issue = null): Response
    {
        $this->config['cmd'] = $cmd;
        $this->config['issue'] = $issue;
        $response = Http::retry(10, 60)->asJson()->post($this->urlAddress,$this->config);
        return $this->exceptionValidate($response);
    }

    /**
     * 历史开奖数据
     * @param int $number
     * @return Response
     * @throws Exception
     */
    public function lotteryHistoryOpenInfo(int $number = 10): Response
    {
        $this->config['issueNum'] = $number;
        return $this->lotteryApi('LotteryHistoryOpenInfo');
    }

    /**
     * @param string $code
     * @return mixed|string
     */
    abstract public function payload(string $code): mixed;

    /**
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function exceptionValidate(Response $response): Response
    {
        if ($response->status() != 200) {
            throw new Exception("接口异常:{$response->body()}");
        }
        if ($response->offsetGet('code') != 0) {
            throw new Exception("接口错误:{$response->offsetGet('desc')}");
        }
        return $response;
    }

}
