<?php


namespace App\Vendors\File;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class File
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg', 'xls', 'xlsx', 'csv', 'apk'];


    /**
     * 存放临时目录
     *
     * @param UploadedFile $file
     * @param string $file_prefix
     * @return string[]|null
     * @throws FileNotFoundException
     */
    public function saveTemp(UploadedFile $file, string $file_prefix = ''): array|null
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        $uploadPath = config('path.upload_temp') . date("Ym/d", time());

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . uniqid() . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowed_ext)) {
            return null;
        }
        // 将图片移动到我们的目标存储路径中
        $path = $uploadPath . '/' . $filename;

        Storage::put($path, $file->get());

        return [
            'path' => $path,
            'link' => Storage::url($path)
        ];
    }
}
