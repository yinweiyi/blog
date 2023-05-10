<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class OfaController extends Controller
{

    public function receive()
    {
        return app('wechat.ofa')->getServer()->serve();
    }
}
