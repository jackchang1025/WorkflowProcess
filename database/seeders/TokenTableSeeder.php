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
                'token' => 'cp062105588718015FCD5123B3401129',
                'created_at' => '2023-04-29 12:47:20',
                'updated_at' => '2023-05-16 20:30:58',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => '射龙门',
                'token' => 'exit_info=; _ga=GA1.2.1185630268.1675951629; _ga_JFHGVP0XS0=GS1.1.1684075905.10.0.1684075905.0.0.0; is_ph=N; BBSESSID=D4E0A750D157E82DAD91CE1A10CD9FA1; MORTLACH=D4E0A750D157E82DAD91CE1A10CD9FA1; casino_logo=; color=gray; bbinwin=true; PHPSESSID=f0744278411c62bd780ab56f71772a9f; mfid=hw5xfF1vehO4rUL6o5JR7Vzdmzu9590IB30h1cPYh8MSuVcpQJM-LWrjE3VTIP4EjKijYHI0YSm1raHwCSh8zDVPYVdsTDBpa3Ztb08zSDY0ZTJCMEpLUmNGd0VPamtUUGZtdTBsWFllSUk; front-token=20A06149338F4B7A34A1D8C622FB6867; exit_option=3; eMobile=0; charset=zh-cn; casino_url=https://777.bbapi.cc; front-domain=https://www.xbblotterygaming.net:443; lang=zh-cn; isLogin=y; QuickSelect={"items":[5,10,20,50],"disable":true,"max":1000000}; hasMessage-zh-cn=0',
                'created_at' => '2023-05-14 13:13:44',
                'updated_at' => '2023-05-16 15:29:41',
            ),
        ));
        
        
    }
}