<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResizeImageRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\V1\ImageManipulation;
use App\Http\Requests\StoreImageManipulationRequest;
use App\Http\Requests\UpdateImageManipulationRequest;
use App\Models\V1\Album;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str; 

class ImageManipulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    //ini create
    public function byAlbum(Album $request){

    }

    /**
     * Store a newly created resource in storage.
     */

     //ini adalah untuk mengatur data yang masuk 
    public function resize(ResizeImageRequest $request)
    {
        $all = $request->all();
        //uploaded File String
        $image = $all['image'];
        unset($all['image']);
        $data = [
            'type' => ImageManipulation::TYPE_RESIZE,
            'data' => json_encode($all),
            'user_id' => null
        ];

        if (isset($all['album_id'])){
            //todo

            $data['album_id'] = $all['album_id'];
        }


        $dir = 'images/'.Str::random().'/';
        $absolutePath = public_path($dir);
        File::makeDirectory($absolutePath);

        //menyimpan gambar di database
        //image/dash2j3da/test.jpg
        //image/dash2j3da/test-resized.jpg
        if ($image instanceof UploadedFile){
            $data['image'] = $image->getClientOriginalName();
            //test.jpg -> test-resize.jpg
            $fileName = pathinfo($data['name'], PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            $image->move($absolutePath, $data['name']);
        } else {

            //jika gambar yang diberikan adalah url
            $data['name'] = pathinfo($image, PATHINFO_BASENAME);
            $fileName = pathinfo($image. PATHINFO_FILENAME);
            $extension = pathinfo($image, PATHINFO_EXTENSION);

            copy($image, $absolutePath.$data['name']);
           
         }
         $data['path'] = $dir.$data['name'];
    }

    /**
     * Display the specified resource.
     */
    public function show(ImageManipulation $imageManipulation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageManipulation $imageManipulation)
    {
        //
    }
}
