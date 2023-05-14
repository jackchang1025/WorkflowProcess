<?php

namespace App\Services;

use App\Services\Lottery\LotteryInterFace;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use WebSocket\BadOpcodeException;
use WebSocket\Client;
use WebSocket\ConnectionException;

class WebSocketClientService implements LotteryInterFace
{
    protected Client $client;
    /**
     * 彩票地址
     * @var string
     */
    protected string $url = 'https://destinedworld9999.net/pt/mem/ajax/config/init.json';

    /**
     * ws地址
     * @var string
     */
    protected string $ws = '';

    /**
     * 上次开奖数据
     * @var array
     */
    protected array $lotteryLastInfo = [];

    /**
     * 当前期数数据
     * @var array
     */
    protected array $lotteryCurrentInfo = [];
    /**
     * @var array 事件
     */
    protected array $events = [];

    /**
     * cookies
     * @var string
     */
    protected string $cookies = 'casino_logo=; color=gray; bbinwin=true; PHPSESSID=2494c55bfde703644473134e4b72b020; exit_option=3; exit_info=; eMobile=0; charset=zh-cn; lang=zh-cn; isLogin=y; QuickSelect={"items":[5,10,20,50],"disable":true,"max":1000000}; _gid=GA1.2.1270790235.1683981124; _ga=GA1.2.1185630268.1675951629; _ga_JFHGVP0XS0=GS1.1.1683985518.3.0.1683985518.0.0.0; nsk_webver=1ebbfd3; BBSESSID=5B16613F59D8C050F667195DB277619E; MORTLACH=5B16613F59D8C050F667195DB277619E; mfid=16j4UU55x0VheO2nx6vuEFXJQI8ASBZbD_66YHHjw2RDjAlf3NLGvtRqqvZM9HpqSbQ1LE4emMyYmAXg_aG-02FjeUx6aGNIYVl6QUd0aXBoZTNheUZSQk94dXlvcTNBRUxQamstOUoyZzQ; front-token=EEEAD1B78F87A57EA5D48D97EA3E77A4; is_ph=N; casino_url=https://777.bbapi.cc; front-domain=https://www.xbblotterygaming.net:443';

    /**
     * @param string $url
     * @param string $cookies
     * @throws BadOpcodeException
     * @throws \Throwable
     */
    public function __construct(string $url, string $cookies)
    {
        $this->url = $url;

        $this->cookies = $cookies;

        //连接 ws
        $this->connect();

        //注册事件
        $this->registerEvent();

    }

    /**
     * @return void
     */
    public function registerEvent(): void
    {
        $this->onPlayResultResultEvent(function (array $response) {
            $result                = $response['data']['payload']['result'];
            $openNum               = "{$result['goalpostleft'][1]},{$result['ball'][1]},{$result['goalpostright'][1]}";
            $this->lotteryLastInfo = [
                'issue'   => $response['data']['payload']['num'],
                'openNum' => $openNum,
            ];
        });

        $this->onStatusEvent(function (array $response) {
            $this->lotteryCurrentInfo = $response['data']['payload']['current'];
        });
    }

    /**
     * @return void
     * @throws BadOpcodeException
     */
    public function listen()
    {
        try {
            while ($message = $this->client->receive()) {
                $data  = json_decode($message, true);
                $event = $data['event'] ?? null;
                if ($event && isset($this->events[$event])) {
                    call_user_func($this->events[$event], $data);
                }
            }
        } catch (BadOpcodeException $e) {
            Log::error('BadOpcodeException in listen: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * @return void
     * @throws BadOpcodeException|\Throwable
     */
    public function connect()
    {
        echo '连接中...' . PHP_EOL;

        //获取 ws 地址
        $this->ws = $this->init();

        $this->client = new Client($this->ws, [
            'headers' => [
                'Cache-Control' => 'no-cache',
                'Host'          => 'destinedworld9999.net',
                'Origin'        => 'https://destinedworld9999.net',
                'Cookie'        => $this->cookies,
                'User-Agent'    => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',
            ],
            'timeout' => 60,
        ]);

        //发送订阅消息
        $this->send(json_encode([
            'data'  => [
                'channel' => 'CBLM'
            ],
            'event' => 'gusher.subscribe'
        ]));
    }

    /**
     * @return void
     * @throws BadOpcodeException
     */
    public function reconnect()
    {
        $this->client->close();
        sleep(5);
        $this->connect();
    }

    /**
     * 获取 ws 地址
     * @return string
     * @throws \Throwable
     */
    public function init(): string
    {
        $response = Http::withCookies($this->resolvesAssociativeArray(), 'destinedworld9999.net')
            ->get("{$this->url}/pt/mem/ajax/config/init.json", [
                'timestamp' => time()
            ]);

        if ($response->failed()) {
            Log::error('Failed to fetch UUID and GSC data: ' . $response->body());
            throw new Exception('Failed to fetch UUID and GSC data'.$response->body());
        }

        $data = $response->object();
        if (empty($data->ws->gsc) || empty($data->ws->uuid)) {
            Log::error('Failed to fetch GSC and UUID data'.$response->body());
            throw new Exception('Failed to fetch GSC and UUID data'.$response->body());
        }

        return "{$data->ws->gsc}?token={$data->ws->uuid}";
    }

    /**
     * 解析cookies为关联数组
     * @return array
     */
    public function resolvesAssociativeArray(): array
    {
        $cookies = [];
        foreach (explode('; ', $this->cookies) as $rawCookie) {
            list($name, $value) = explode('=', $rawCookie, 2);
            $cookies[$name] = urldecode($value);
        }
        return $cookies;
    }

    /**
     * 获取服务器数据
     * @return mixed|string|\WebSocket\Message\Message|null
     */
    public function receive(): mixed
    {
        return $this->client->receive();
    }

    /**
     * 发送消息
     * @param string $payload
     * @param string $opcode
     * @param bool $masked
     * @return void
     * @throws BadOpcodeException
     */
    public function send(string $payload, string $opcode = 'text', bool $masked = true): void
    {
        try {

            $this->client->send($payload, $opcode, $masked);
        } catch (BadOpcodeException $e) {
            Log::error($e->getMessage());

            throw $e;
        }
    }

    public function onPlayResultResultEvent(callable $callback)
    {
        $this->onEvent('playResult', $callback);
    }

    public function onStatusEvent(callable $callback)
    {
        $this->onEvent('status', $callback);
    }

    /**
     * 设置消息事件
     * @param string $event
     * @param callable $callback
     * @return void
     */
    public function onEvent(string $event, callable $callback): void
    {
        $this->events[$event] = $callback;
    }

    /**
     * 循环获取服务器数据根据消息事件设置属性，
     * @return void
     * @throws BadOpcodeException
     */
    public function run()
    {
        while (true) {
            try {
                $this->listen();
            } catch (ConnectionException $e) {
                Log::error('ConnectionException in run: ' . $e->getMessage());
                $this->reconnect();
            }
        }
    }

    /**
     * 上次开奖数据
     * @return array
     */
    public function lotteryLastInfo(): array
    {
        return $this->lotteryLastInfo;
    }

    /**
     * 当前期信息
     * @return array|mixed
     */
    public function lotteryCurrentInfo()
    {
        return $this->lotteryCurrentInfo;
    }

    public function lotteryHistoryOpenInfo(int $number)
    {
        return [];
    }

    public function lotteryBet(int $issue, string $betCode, float $betAmount)
    {
        // TODO: Implement lotteryBet() method.
    }

    /**
     * 当前期信息开始时间戳
     * @return int|mixed
     */
    public function beginTime()
    {
        return $this->lotteryCurrentInfo['open_timestamp'] ?? 0;
    }

    /**
     * 当前期信息结束时间戳
     * @return int|mixed
     */
    public function endTime()
    {
        return $this->lotteryCurrentInfo['close_timestamp'] ?? 0;
    }

    /**
     * 是否可以投注
     * @return bool
     */
    public function isCurrentBet(): bool
    {
        return time() - $this->endTime() > 5;
    }

    /**
     * 距离下期休眠事件
     * @return bool
     */
    public function sleep(): bool
    {
        return time() - $this->beginTime() > 10;
    }
}
