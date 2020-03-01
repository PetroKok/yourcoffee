<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
    public function moveImage(UploadedFile $file, string $image_path);

    public function deleteImage(string $image_name);
}
