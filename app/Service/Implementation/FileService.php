<?php


namespace App\Service\Implementation;


use App\Service\Interfaces\FileServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class FileService implements FileServiceInterface
{
    public function moveImage(UploadedFile $file, string $image_path)
    {
        $image_name = Carbon::today()->format('Y-m-d') . '-' . $file->getClientOriginalName();
        $path = storage_path('app/public') . $image_path;
        $file->move($path, $image_name);
        try {
            $path = $path . '/' . $image_name;
            Image::make($path)->resize(600, 600)->save();
        } catch (\Throwable $e) {
        }
        return $image_name;
    }

    public function deleteImages(array $images)
    {
        foreach ($images as $image) {
            $this->deleteImage($image);
        }
    }

    public function deleteImage(string $image)
    {
        if ($image) {
            $full_path = storage_path('app/public') . $image;
            if (\File::exists($full_path)) {
                try {
                    \File::delete($full_path);
                } catch (\Throwable $e) {
                    throw $e;
                }
            }
        }
    }
}
