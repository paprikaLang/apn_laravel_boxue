<?php

use Illuminate\Database\Seeder;

class RsaKeysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rsa_keys')->truncate(); //重置rsa_keys表, 每次更新数据都从ID=1开始
        factory(App\RsaKey::class, 2)->create(); //存入表中, 而make方法只生成不存储
    }
}
