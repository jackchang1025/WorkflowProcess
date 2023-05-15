<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TokenTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('token')->delete();
        
        \DB::table('token')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '极速快三',
                'token' => 'cp0621055887141EE36E84236329e76c',
                'created_at' => '2023-04-29 12:47:20',
                'updated_at' => '2023-05-15 16:09:49',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '射龙门',
                'token' => 'casino_logo=; color=gray; bbinwin=true; PHPSESSID=2494c55bfde703644473134e4b72b020; exit_option=3; exit_info=; eMobile=0; charset=zh-cn; lang=zh-cn; isLogin=y; QuickSelect={"items":[5,10,20,50],"disable":true,"max":1000000}; _gid=GA1.2.1270790235.1683981124; bblm_isMute=true; _ga=GA1.2.1185630268.1675951629; _ga_JFHGVP0XS0=GS1.1.1684075905.10.0.1684075905.0.0.0; BBSESSID=D5AF980A9E76A13639E33254CB7B0E2F; MORTLACH=D5AF980A9E76A13639E33254CB7B0E2F; mfid=IpBCUhLGHAb0T6v9aqhDfqiyYHZWCgZYqtU9ESblfZ1yopntS05vrlaTXc7SStARqTkqkXWdSnm7Sd6hQVeM3HNuRVFDWHkxRTlGbHNYNnFMOEgzNGhTZDRjaVB1bHRETDNHa3Y2ZGI0Ujg; front-token=B967A702B2437D0BB646D113BC9E4DA1; is_ph=N; casino_url=https://777.bbapi.cc; front-domain=https://www.xbblotterygaming.net:443',
                'created_at' => '2023-05-14 13:13:44',
                'updated_at' => '2023-05-15 16:03:07',
            ),
        ));
        
        
    }
}