<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Vendors\File\OSS;
use EasyWeChat\Kernel\Form\File;
use EasyWeChat\Kernel\Form\Form;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageToMaterial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:to_material';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Image table image_url to official account material';

    /**
     * @var Application|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private Application $ofaApp;

    public function __construct()
    {
        parent::__construct();
        $this->ofaApp = app('wechat.ofa');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $images = Image::query()->where('material_id', '')->orderByDesc('id')->select('id', 'image_url')->get();

        $ossConfig = Config::get('oss');

        foreach ($images as $image) {
            if (!Str::startsWith($image->image_url, $ossConfig['domain'])) {
                continue;
            }
            $this->info('Transform ：' . $image->image_url);

            $path = Str::replace($ossConfig['domain'] . '/ai-image/', '/storage/', $image->image_url);
            $storagePath = Storage::path($path);
            if (!is_file($storagePath)) {
                $this->error('File not found:' . $storagePath);
                continue;
            }
            $this->info('正在处理：' . $image->image_url);

            $options = Form::create(
                [
                    'media' => File::fromPath($storagePath)
                ]
            )->toArray();

            $options['query'] = ['type' => 'image'];

            $response = $this->ofaApp->getClient()->post('/cgi-bin/material/add_material', $options);

            $content = \json_decode($response->getContent(), true);

            if ($mediaId = Arr::get($content, 'media_id')) {
                $image->fill(['media_id' => $mediaId])->save();
                $this->info('处理成功。。。');
            } else {
                $this->error('处理失败。。。');
            }
        }
    }
}
