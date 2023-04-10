<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Vendors\File\File;

class FileController extends Controller
{
    /**
     * 文件上传
     *
     * @param Request $request
     * @param File $fileHandler
     * @return JsonResponse
     * @throws FileNotFoundException
     */
    public function upload(Request $request, File $fileHandler): JsonResponse
    {
        $file = $request->file('file');
        // 判断文件是否有效
        if (!is_object($file) || !$file->isValid()) {
            return $this->error('文件不合法');
        }

        return $this->success($fileHandler->saveTemp($file));
    }
}
