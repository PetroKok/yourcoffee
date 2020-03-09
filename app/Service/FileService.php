<?php


namespace App\Service;


use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class FileService implements FileServiceInterface
{
    public function moveImage(UploadedFile $file, string $image_path)
    {
        $image_name = Carbon::today()->format('Y-m-d') . '-' . $file->getClientOriginalName();
        $file->move(public_path($image_path), $image_name);
        return $image_name;
    }

    public function deleteImages(array $images)
    {
        foreach ($images as $image) {
            if ($image) {
                $full_path = public_path($image);
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
}
