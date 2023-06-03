<?php

namespace App\Http\Controllers\Pages;

use App\Models\Frame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image as ModelsImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ExcuteProductController extends Controller
{
    private function hanldeMergedImage(string $username, string $fileImageName)
    {
        // Make directory for excute username
        $folderUsername = Storage::disk(ModelsImage::DISK)->path("/merge/$username");
        if (!File::exists($folderUsername)) {
            Storage::disk(ModelsImage::DISK)->makeDirectory("/merge/$username");
        }

        // Load the username image you want to merge
        $files = Storage::disk(ModelsImage::DISK)->files('products');
        $imageFrame = Image::make(Storage::disk(ModelsImage::DISK)->get("frames/$fileImageName"));

        // Config size for frame
        $marginWidth = 15;
        $marginHeight = 100;
        $x = 0;
        $y = $marginHeight - 90;
        foreach ($files as $file) {
            $imageFile = Storage::disk(ModelsImage::DISK)->get('products/' . basename($file));
            $imageInfo = @getimagesize($imageFile);
            if ($imageInfo === false) {
                break;
            }
            $imageTemp = Image::make($imageFile);
            // Get the dimensions of the second image
            $imageProductWidth = $imageTemp->getWidth();
            $imageProductHeight = $imageTemp->getHeight();
            $imageFrame->resize($imageProductWidth + $marginWidth, $imageProductHeight + $marginHeight);
            // Merge the images by placing the second image in the middle of the first image
            $imageFrame->insert($imageTemp, 'center', (int) $x, (int) $y);
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
    public function excute(Request $request, $username)
    {
        $frame = Frame::whereUsername($username)->first();
        $this->hanldeMergedImage($username, basename($frame->image->src));
        return $this->index()->with([
            'images' => Storage::disk(ModelsImage::DISK)->files('merge/' . $username)
        ]);
    }
}
