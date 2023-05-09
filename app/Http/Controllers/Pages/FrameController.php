<?php

namespace App\Http\Controllers\Pages;

use App\Models\Frame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class FrameController extends Controller
{
    private function data()
    {
        return Frame::with('image')->get();
    }

    private function uploadImage(Request $request) : Image
    {
        // Save Image to Storage
        $file = $request->file('image');
        $fileName   = time() . '.' . $file->getClientOriginalExtension();
        $path = 'frames/' . $fileName;
        Storage::disk(Image::DISK)->put($path, $file);
        // Save Image to DB
        $image = Image::create([
            'key' => 'frame',
            'title' => $fileName,
            'src' => $path
        ]);
        return $image;
    }

    public function index()
    {
        return view('pages.frame', [
            'data' => $this->data()
        ]);
    }

    public function add()
    {
        return view('pages.frame-add');
    }

    public function create(Request $request)
    {
        $image = $this->uploadImage($request);
        $request->merge(['image_id' => $image->id]);
        // Save Frame to DB
        Frame::create($request->except('image'));
    }

    public function update($id, Request $request)
    {
        if ($request->input('has_update_image')) {
            $image = $this->uploadImage($request);
            $request->merge(['image_id' => $image->id]);
        }
        // Save Frame to DB
        Frame::find($id)
            ->update($request->except([
                'image',
                'has_update_image'
            ]));
    }

    public function delete($id)
    {
        $status = Frame::find($id)->delete();
        return response([
            'status' => $status,
            'id' => $id
        ]);
    }
}
