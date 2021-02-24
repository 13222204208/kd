<?php

namespace App\Http\Controllers\Minapp\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceAgreement;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    public function agreement()
    {
        try {
            $data= ServiceAgreement::find(1);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
