<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class OfaController extends Controller
{

    public function auth()
    {
        return app('wechat.ofa')->getServer()->serve();
    }

    public function receive()
    {
        return 'ok';
    }
}
