<?php

namespace App\Service\Interfaces;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

interface FileServiceInterface
{
    public function moveImage(UploadedFile $file, string $image_path);

    public function deleteImages(array $images);

    public function deleteImage(string $image);
}
