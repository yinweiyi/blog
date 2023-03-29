<?php

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

if (!function_exists('random_color')) {
    /**
     * 随机颜色
     *
     * @return string
     */
    function random_color(): string
    {
        $colors = array();
        for ($i = 0; $i < 6; $i++) {
            $colors[] = dechex(rand(0, 15));
        }
        return '#' . implode('', $colors);
    }
}

if (!function_exists('find_number')) {
    /**
     * find number from str
     *
     * @param string $str
     * @param int $min_len
     * @param int $max_len
     * @return string
     */
    function find_number(string $str = '/', int $min_len = 5, int $max_len = 100): string
    {
        $pattern = sprintf('/\d{%d,%d}/', $min_len, $max_len);
        preg_match($pattern, $str, $matches);
        return $matches[0] ?? '';
    }
}

if (!function_exists('mini_html')) {
    /**
     * mini_html
     *
     * @param $value
     * @return string
     */
    function mini_html($value): string
    {
        $value = preg_replace_callback('/<pre>([\S\s]*?)<\/pre>/', function ($matches) {
            $match = $matches[0];
            return str_replace(["\r\n", "\r", "\n"], '<br />', $match);
        }, (string)$value);

        $replace = array(
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/\n([\S])/" => ' $1',
            "/\r/" => '',
            "/\n/" => '',
            "/\t/" => ' ',
            "/ +/" => ' ',
        );
        return preg_replace(array_keys($replace), array_values($replace), $value);
    }
}


if (!function_exists('i_view')) {
    /**
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @return string
     */
    function i_view($view = null, array $data = [], array $mergeData = []): string
    {
        $view = view($view, $data, $mergeData);
        return mini_html($view);
    }
}
