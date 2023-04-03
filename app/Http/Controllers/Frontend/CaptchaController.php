<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;

class CaptchaController extends Controller
{

    /**
     * 验证码图片
     *
     * @param Request $request
     * @return mixed
     */
    public function captcha(Request $request): mixed
    {
        return Captcha::create($request->query('type', 'default'));
    }
}
