<?php

namespace App\Http\Controllers\Pages;

use App\Models\Frame;
use App\Http\Requests\FrameRequest as Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\MainResponse;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FrameController extends Controller
{
    private function data()
    {
        return Frame::with('image')->get();
    }

    private function uploadImage(Request $request): Image
    {
        // Save Image to Storage
        $file = $request->file('image');
        $fileName   = $file->getFilename() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = 'frames/' . $fileName;
        Storage::disk(Image::DISK)->put($path, file_get_contents($file));
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

    /**
     * CRUD
     * create frame
     */
    public function create(Request $request)
    {
        // upload image
        $image = $this->uploadImage($request);
        $request->merge(['image_id' => $image->id]);
        // Save Frame to DB
        $create = Frame::create($request->except('image'));
        return MainResponse::response($request, [
            'data' => $create
        ]);
    }

    /**
     * CRUD
     * update frame
     */
    public function update($id, Request $request)
    {
        $validateData = $request->validated();
        if ($request->input('has_update_image')) {
            $image = $this->uploadImage($request);
            $request->merge(['image_id' => $image->id]);
        }
        // Save Frame to DB
        $update = Frame::find($id)
            ->update($request->except([
                'image',
                'has_update_image'
            ]));
        return MainResponse::response($request, [
            'data' => $update
        ]);
    }

    /**
     * CRUD
     * delete frame
     */
    public function delete(Request $request, $id)
    {
        $status = Frame::find($id)->delete();
        return response([
            'status' => $status,
            'id' => $id
        ]);
    }
}
