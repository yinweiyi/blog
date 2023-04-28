<?php


namespace App\Vendors\File;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;
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
     * @param string $filePrefix
     * @param int $maxWidth
     * @return string[]|null
     * @throws FileNotFoundException
     */
    public function updateImage(UploadedFile $file, string $filePrefix = '', int $maxWidth = 0): array|null
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        $uploadPath = date("Ym/d", time());

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $filePrefix . uniqid() . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if (!in_array($extension, $this->allowedImageExtend)) {
            return null;
        }
        // 将图片移动到我们的目标存储路径中
        $path = $uploadPath . '/' . $filename;

        Storage::put($path, $file->get());
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make(Storage::path($path));

        if ($maxWidth > 0 && $image->getWidth() > $maxWidth ) {
            // 进行大小调整的操作
            $image->resize($maxWidth, null, function ($constraint) {
                // 设定宽度是 $max_width，高度等比例缩放
                $constraint->aspectRatio();

                // 防止裁图时图片尺寸变大
                $constraint->upsize();
            });
        }

        // 对图片修改后进行保存
        $image->save();


        return [
            'path'   => $path,
            'link'   => Storage::url($path),
            'width'  => $image->getWidth(),
            'height' => $image->getHeight()
        ];
    }
}
