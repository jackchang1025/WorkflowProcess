<?php

namespace App\Console\Commands;

use App\Models\Lottery;
use App\Models\LotteryOption;
use App\Models\Request;
use App\Models\RequestLog;
use App\Models\Token;
use App\Services\Lottery\LotteryOptionService;
use App\Services\WebSocketClientService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class WebSocketClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webSocket:client{--L|lotteryId=}{--T|tokenId=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected LotteryOptionService $lotteryOptionService;

    /**
     * @param LotteryOptionService $lotteryOptionService
     */
    public function __construct(LotteryOptionService $lotteryOptionService)
    {
        parent::__construct();

        $this->lotteryOptionService = $lotteryOptionService;
    }


    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception|\Throwable
     */
    public function handle()
    {

        $lotteryId = $this->option('lotteryId');
        $tokenId   = $this->option('tokenId');

        $lottery = Lottery::findOrFail($lotteryId);

        if ($lottery->status == Lottery::STATUS_OFF) {
            throw new \Exception('彩种已关闭');
        }
        $token = Token::findOrFail($tokenId);

        $request                         = new Request();
        $request->bpmn_xml               = '';
        $request->title                  = '射龙门';
        $request->lottery_id             = $lotteryId;
        $request->code_type              = 0;
        $request->status                 = Request::STATUS_PENDING;
        $request->stop_betting_amount    = 0;
        $request->bet_base_amount_rules  = 0;
        $request->bet_total_amount_rules = 0;
        $request->total_amount_rules     = 0;
        $request->save();

        $request->requestLotteryOption()->detach();          // 移除所有已存在的关联
        $request->requestLotteryOption()->attach([7, 8, 9]); // 关联新的记录

        $client = new WebSocketClientService($lottery->url, $token->token);

        $client->onEvent('playResult', function (array $response) use ($request) {

            $request = $request->with(['requestLotteryOption'])->find($request->id);

            $result = $response['data']['payload']['result'];
            $code   = "{$result['goalpostleft'][1]},{$result['ball'][1]},{$result['goalpostright'][1]}";

            //匹配开奖选项 设置开奖规则 父节点title设置为 key
            $validateLotteryOption = $request->requestLotteryOption->filter(function (LotteryOption $item) use ($code) {

                return $this->lotteryOptionService->validateOptionWithParents($item, $code);
            })->each(function (LotteryOption $item) use ($request) {

                //开奖规则
                $request->appendLotteryRules($item->parentNode->title ?? $item->title, $item->value);
            });

            RequestLog::create([
                'issue'                    => $response['data']['payload']['num'],
                'bet_total_amount'         => 0,
                'lottery_code'             => $code,
                'request_id'               => $request->id,
                'bet_code_transform_value' => $validateLotteryOption->first()->value,
                'bet_code_odds'            => $validateLotteryOption->first()->odds,
            ]);

            //开奖总次数
            $request->lottery_count_rules++;
            $request->save();

            $this->info('[' . Carbon::now() . "] playResult: {$response['data']['payload']['num']} {$code} {$validateLotteryOption->first()->value}");
        });

        $client->run();
    }
}
