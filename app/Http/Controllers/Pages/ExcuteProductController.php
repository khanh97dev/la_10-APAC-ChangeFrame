<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Image as ModelsImage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ExcuteProductController extends Controller
{
    private function hanldeMergedImage(string $username, string $frameImage)
    {
        // Make directory for excute username
        $folderUsername = Storage::disk(ModelsImage::DISK)->path("/merge/$username");
        if (!File::exists($folderUsername)) {
            Storage::disk(ModelsImage::DISK)->makeDirectory("/merge/$username");
        }

        // Load the username image you want to merge
        $files = Storage::disk(ModelsImage::DISK)->files('products');
        $imageFrame = Image::make(Storage::disk(ModelsImage::DISK)->get("frames/$frameImage"));

        // Config size for frame
        $marginWidth = 15;
        $marginHeight = 100;
        $x = 0;
        $y = $marginHeight - 90;
        foreach ($files as $file) {
            $imageProduct = Image::make(
                Storage::disk(ModelsImage::DISK)->get('products/' . basename($file))
            );
            // Get the dimensions of the second image
            $imageProductWidth = $imageProduct->getWidth();
            $imageProductHeight = $imageProduct->getHeight();
            $imageFrame->resize($imageProductWidth + $marginWidth, $imageProductHeight + $marginHeight);
            // Merge the images by placing the second image in the middle of the first image
            $imageFrame->insert($imageProduct, 'center', (int) $x, (int) $y);
            // Save the merged image
            $mergedImagePath = $folderUsername . '/' . basename($file);
            $imageFrame->save($mergedImagePath);
        }

    }


    public function index()
    {
        return view('pages.excute-product');
    }

    /**
     * Method: GET
     */
    public function excute(Request $request, $username, $frameImage)
    {
        $this->hanldeMergedImage($username, $frameImage);
        return $this->index()->with([
            'images' => Storage::disk(ModelsImage::DISK)->files('merge/' . $username)
        ]);
    }
}
