<?php

namespace Database\Seeders;

use App\Models\ServiceAgreement;
use Illuminate\Database\Seeder;

class ServiceAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new ServiceAgreement();
        $data->title = "服务协议";
        $data->content = "服务协议内容";
        $data->save();
    }
}
