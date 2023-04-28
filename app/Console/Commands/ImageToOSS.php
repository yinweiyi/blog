<?php

namespace App\Console\Commands;

use App\Models\Image;
use App\Vendors\File\OSS;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageToOSS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:to_oss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Image table image_url to oss';

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $images = Image::query()->orderByDesc('id')->select('id', 'image_url')->get();
        $appConfig = Config::get('app');

        $ossConfig = Config::get('oss');
        $oss = new OSS($ossConfig);

        foreach ($images as $image) {
            if (!Str::startsWith($image->image_url, $appConfig['url'])) {
                continue;
            }
            $this->info('Uploading ：' . $image->image_url);

            $path = Str::replace($appConfig['url'] . '/storage/', '', $image->image_url);
            $storagePath = Storage::path($path);
            $ossPath = 'ai-image/' . $path;
            $oss->upload($ossPath, $storagePath);

            $url = $ossConfig['domain'] . '/' . $ossPath;
            $image->fill(['image_url' => $url])->save();
            $this->info('Upload success, url is:' . $url);
        }
    }
}
