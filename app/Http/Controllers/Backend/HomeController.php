<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * 首页数据
     *
     * @return JsonResponse
     */
    public function dashboard(): JsonResponse
    {
        return $this->success(null, [
            'systems' => $this->systems(),
            'frameworks' => $this->frameworks(),
            'extends' => $this->extends(),
        ]);
    }

    /**
     * 系统
     *
     * @return array[]
     */
    protected function systems(): array
    {
        return [
            ['操作系统', php_uname()],
            ['运行环境', request()->server('SERVER_SOFTWARE')],
            ['PHP环境', sprintf('%s (%s)', PHP_VERSION, php_sapi_name())],
            ['MYSQL版本', DB::connection()->getPdo()->getAttribute(\PDO::ATTR_SERVER_VERSION)],
            ['上传大小限制', sprintf('%s (PHP环境允许上传附件的大小限制)', ini_get('upload_max_filesize'))],
            ['表单大小限制', sprintf('%s (会影响上传附件大小)', ini_get('post_max_size'))],
            ['执行时间限制', sprintf('%s秒 (0表示无限制)', ini_get('max_execution_time'))],
            ['运行内存限制', sprintf('%s (允许PHP脚本使用的最大内存)', ini_get('memory_limit'))],
            ['剩余空间', human_filesize(disk_free_space('.'))],
        ];
    }

    /**
     * 框架
     *
     * @return array
     */
    protected function frameworks(): array
    {
        return [
            ['Laravel 版本', app()->version()],
            ['timezone', config('app.timezone')],
            ['缓存驱动', config('cache.default')],
            ['队列驱动', config('queue.default')],
            ['接口过期时间(分)', config('sanctum.expiration') . ''],
            ['日志channel', config('logging.default')],
            ['Session驱动', config('session.driver')],
            ...$this->pathsInfo([['name' => 'storage权限', 'path' => storage_path()]])
        ];
    }

    /**
     * 扩展
     *
     * @return array
     */
    protected function extends(): array
    {
        $extends = [
            ['openssl', 'openssl', '框架', 'openSSL 是一个强大的安全套接字层密码库，囊括主要的密码算法、常用的密钥和证书封装管理功能及SSL协议，并提供丰富的应用程序供测试或其它目的使用。'],
            ['mbstring', 'mbstring', '框架', 'mbstring 提供了针对多字节字符串的函数，能够帮你处理 PHP 中的多字节编码。 除此以外，mbstring 还能在可能的字符编码之间相互进行编码转换。'],
            ['gd2', 'gd', '验证码', 'gd2 提供了创建和处理包括 GIF， PNG， JPEG， WBMP 以及 XPM 在内的多种格式的图像。'],
            ['cURL', 'curl', '推送', 'PHP支持的由Daniel Stenberg创建的libcurl库允许你与各种的服务器使用各种类型的协议进行连接和通讯。'],
            ['fileinfo', 'fileinfo', '上传', 'fileinfo 中的函数通过在文件的给定位置查找特定的 魔术 字节序列 来猜测文件的内容类型以及编码。 虽然不是百分百的精确， 但是通常情况下能够很好的工作。'],
        ];

        return $this->extendsInfo($extends);

    }

    /**
     * @param $dirs
     * @return array
     */
    protected function pathsInfo($dirs): array
    {
        $results = [];
        foreach ($dirs as $dir) {

            if (!is_dir($dir['path'])) {
                $column = [['text' => '不可读', 'type' => 'danger'], ['text' => '不可写', 'type' => 'danger']];
            } else {
                $column = is_readable($dir['path']) ? [['text' => '可读', 'type' => 'primary']] : [['text' => '不可读', 'type' => 'danger']];
                $column[] = is_writable($dir['path']) ? ['text' => '可写', 'type' => 'primary'] : ['text' => '不可写', 'type' => 'danger'];
            }
            $results[] = [$dir['name'], $column];
        }
        return $results;
    }

    /**
     * @param $extends
     * @return array
     */
    protected function extendsInfo($extends): array
    {
        $results = [];
        foreach ($extends as $extend) {
            list($name, $extension, $type, $remark) = $extend;
            $results[] = [$name, extension_loaded($extension) ? ['text' => '正常', 'type' => 'primary'] : ['text' => '异常', 'type' => 'danger'], $type, $remark];
        }
        return $results;
    }

}
