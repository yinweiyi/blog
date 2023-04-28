<?php


namespace App\Vendors\File;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class File
{
    protected array $allowedImageExtend = ["png", "jpg", "gif", 'jpeg'];


    /**
     * 存放临时目录
     *
     * @param UploadedFile $file
     * @param $data
     * @return string[]|null
     * @throws FileNotFoundException
     */
    public function updateImage(UploadedFile $file, $data): array|null
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        $uploadPath = $this->getUploadDir(Arr::get($data, 'prefix', 'baigei'));

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = $this->getFileExtension($file);

        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowedImageExtend)) {
            return null;
        }

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $this->getFileName($extension);

        // 将图片移动到我们的目标存储路径中
        $path = $uploadPath . '/' . $filename;

        //本地存储
        Storage::put($path, $file->get());

        //本地路径
        $storagePath = Storage::path($path);

        //上传oss
        $url = $this->uploadOss($path, $storagePath);

        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($storagePath);

        return [
            'path'   => $path,
            'link'   => $url,
            'width'  => $image->getWidth(),
            'height' => $image->getHeight()
        ];
    }


    /**
     * 文件夹
     *
     * @param $prefix
     * @return string
     */
    private function getUploadDir($prefix): string
    {
        return $prefix . '/' . date("Ym/d", time());
    }

    /**
     * 文件后缀
     *
     * @param UploadedFile $file
     * @return string
     */
    private function getFileExtension(UploadedFile $file): string
    {
        return strtolower($file->getClientOriginalExtension()) ?: 'png';
    }


    /**
     * @param string $extension
     * @return string
     */
    private function getFileName(string $extension): string
    {
        return uniqid() . '.' . $extension;
    }


    /**
     * 上传oss
     *
     * @param $path
     * @param $storagePath
     * @return string
     */
    private function uploadOss($path, $storagePath): string
    {
        $config = Config::get('oss');
        $oss = new OSS($config);
        $oss->upload($path, $storagePath);

        return $config['domain'] . '/' . $path;
    }


}
