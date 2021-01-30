<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Service\Interfaces\FileServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PosterAssetController extends Controller
{
    public string $poster = "https://joinposter.com/";
    public string $path = "public/products/";
    public $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(Request $request, $poster_image)
    {
        $image_name = substr($poster_image, strrpos($poster_image, '/') + 1);

        if (!file_exists(Storage::path($this->path) . $image_name)) {
            $image = file_get_contents($this->poster . $poster_image);
            if (!is_dir(Storage::path($this->path))) {
                mkdir(Storage::path($this->path));
            }
            file_put_contents(Storage::path($this->path) . $image_name, $image);
        }

        return response()->download(Storage::path($this->path . $image_name), null, [], null);
    }
}
