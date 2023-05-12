<?php

namespace App\Http\Services;

use App\Models\Image;

class ImageService
{

    /**
     * @return mixed
     */
    public function randomMediaId(): mixed
    {
        $mediasId = Image::query()->where('media_id', '!=', '')->pluck('media_id');
        return $mediasId->random();
    }
}
