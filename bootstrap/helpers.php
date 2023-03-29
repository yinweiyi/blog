<?php


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

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
            "/\n([\S])/"                => ' $1',
            "/\r/"                      => '',
            "/\n/"                      => '',
            "/\t/"                      => ' ',
            "/ +/"                      => ' ',
        );
        return preg_replace(array_keys($replace), array_values($replace), $value);
    }
}


if (!function_exists('i_view')) {
    /**
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @return Factory|View
     */
    function i_view($view = null, array $data = [], array $mergeData = []): Factory|View
    {
        $view = view($view, $data, $mergeData);
        return mini_html($view);
    }
}
