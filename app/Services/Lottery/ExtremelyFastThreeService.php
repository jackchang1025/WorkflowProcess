<?php

namespace App\Services\Lottery;

use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ExtremelyFastThreeService extends AbstractLotteryService implements LotteryInterFace
{
    protected array $config;

    protected string $urlAddress;

    static array $payload = [
        '大' => '121101027',
        '小' => '121101028',
        '单' => '121101029',
        '双' => '121101030',
    ];

    /**
     * 获取上一期开奖信息
     * @param int|null $issue
     * @return array
     * @throws Exception|Throwable
     */
    public function lotteryLastInfo(int $issue = null): array
    {
        return retry(5, function () use ($issue) {
            $response =  $this->lotteryApi('IssueLastOpenInfo', $issue)['data']['lastIssueEntity'];

            throw_if(empty($response['issue']), new Exception('获取上一期开奖期号为空'));
            throw_if(empty($response['openNum']), new Exception('获取上一期开奖号码为空'));

            return $response;
        }, $this->sleepMilliseconds);
    }


    /**
     * 获取当前期数信息
     * @return array
     * @throws Exception|Throwable
     */
    public function lotteryCurrentInfo(): array
    {
        return retry(5, function () {
            return $this->lotteryApi('LotteryCurrentInfo')['data'];
        }, $this->sleepMilliseconds);
    }


    /**
     * 当前期数开始时间
     * @return int
     * @throws Throwable
     */
    public function beginTime(): int
    {
        if (empty($beginTime = $this->lotteryCurrentInfo()['beginTime'])){
            throw new Exception('当前期数开始时间为空');
        }
        return strtotime($beginTime);
    }

    /**
     * 当前期数结束时间
     * @return int
     * @throws Throwable
     */
    public function endTime(): int
    {
        if (empty($endTime = $this->lotteryCurrentInfo()['endTime'])){
            throw new Exception('当前期数开始时间为空');
        }
        return strtotime($endTime);
    }

    /**
     * @param string $code
     * @return mixed|string
     */
    public function payload(string $code): mixed
    {
        return self::$payload[$code];
    }

    /**
     * 历史开奖数据
     * @param int $number
     * @return Response
     * @throws Exception|Throwable
     */
    public function lotteryHistoryOpenInfo(int $number = 10): Response
    {
        $this->config['issueNum'] = $number;
        return $this->lotteryApi('LotteryHistoryOpenInfo');
    }

    /**
     * 当前是否可以投注
     * @return bool
     * @throws Exception|Throwable
     */
    public function isCurrentBet(): bool
    {
        return time() > $this->beginTime() && $this->endTime() - time() >= 10;
    }

    /**
     * 投注
     * @param int $issue
     * @param string $betCode
     * @param float $betAmount
     * @return Response
     * @throws Exception|Throwable
     */
    public function lotteryBet(int $issue, string $betCode, float $betAmount): Response
    {
        $this->config['betList']  = "[{\"playId\":{$this->payload($betCode)},\"buyCode\":\"$betCode\",\"buyCodeFront\":\"$betCode\",\"singleMoney\":$betAmount,\"buyDouble\":1,\"moneyUnit\":3,\"rebateRate\":0,\"imp\":0}]";
        $this->config['identity'] = time();
        $this->config['cmd']      = 'LotteryUserBet';
        $this->config['issue']    = $issue;
        Log::debug('开始投注 ==> ' . json_encode($this->config));
        return $this->lotteryApi('LotteryUserBet', $issue);
    }

    /**
     * 接口提交
     * @param string $cmd
     * @param int|null $issue
     * @return Response
     * @throws Exception|Throwable
     */
    public function lotteryApi(string $cmd, int $issue = null): Response
    {
        $this->config['cmd']   = $cmd;
        $this->config['issue'] = $issue;
        return $this->exceptionValidate(
            Http::retry(10, 60)
                ->asJson()
                ->post($this->urlAddress, $this->config)
        );
    }

    /**
     * @param Response $response
     * @return Response
     * @throws Exception|Throwable
     */
    public function exceptionValidate(Response $response): Response
    {
        throw_if($response->status() != 200, new Exception("接口异常:{$response->body()}"));

        throw_if($response->offsetGet('code') != 0, new Exception("接口错误:{$response->offsetGet('desc')}"));

        return $response;
    }

    /**
     * @return int
     * @throws Throwable
     */
    public function sleep(): int
    {
        return $this->endTime() - time() + 20;
    }
}
