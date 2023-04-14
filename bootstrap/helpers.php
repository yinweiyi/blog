<?php
if (!function_exists('app_url')) {
    /**
     * APP
     *
     * @param string $url
     * @return string
     */
    function app_url(string $url = '/'): string
    {
        return $url == '/' ? config('app.url') : config('app.url') . '/' . $url;
    }
}

if (!function_exists('human_filesize')) {

    /**
     * 格式化容量为易读字符串
     *
     * @param int $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize(int $bytes, int $decimals = 2): string
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

}

if (!function_exists('array_filter_null')) {
    /**
     * 移除数组null
     *
     * @param array $array
     * @return array
     */
    function array_filter_null(array $array = []): array
    {
        return array_filter($array, function ($item) {
            return !is_null($item);
        });
    }
}

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

if (!function_exists('unlimited_for_layer')) {
    /**
     * @param $array
     * @param int $id
     * @param int $level
     * @param string $parentId
     * @return array
     */
    function unlimited_for_layer($array, int $id = 0, int $level = 0, string $parentId = 'parent_id'): array
    {
        $list = array();
        foreach ($array as $k => $v) {
            if ($v[$parentId] == $id) {
                $v['level'] = $level;
                $v['children'] = unlimited_for_layer($array, $v['id'], $level + 1);
                $list[] = $v;
            }
        }
        return $list;
    }
}
