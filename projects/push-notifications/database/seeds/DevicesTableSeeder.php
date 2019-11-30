<?php

use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->truncate(); //重置rsa_keys表, 每次更新数据都从ID=1开始
        factory(App\Device::class, 5)->create();
    }
}
