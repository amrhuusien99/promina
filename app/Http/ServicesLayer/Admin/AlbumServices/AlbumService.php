<?php

namespace App\Http\ServicesLayer\Admin\AlbumServices;

use App\Models\Album;
use Illuminate\Support\Facades\File;

class AlbumService
{

    protected $model;
    public function __construct(Album $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        $album = $this->model->create(['name' => $request->name]);
        if (isset($request->images)) {
            foreach ($request->images as $record) {
                
                if(isset($record['image']) && !is_null($record['image'])){

                    $album->album_images()->create([
                        'name' => $record['name'] ?? '',
                        'img' => uploadIamge($record['image'], 'albums') // function on helper file to upload file
                    ]);
                }
            }
        }
        return $album;
    }

    public function update($request, $id)
    {

        $album = $this->model->find($id);
        if (isset($request->images)) {

            foreach ($request->images as $record) {

                if((int)$record['record_id'] != 0){

                    $imgData = [
                        'name' => $record['name'] ?? '',
                        'img' => isset($record['image']) ? uploadIamge($record['image'], 'albums') : NULL,
                    ];
                    $album->album_images()->find($record['record_id'])->update(
                        array_filter($imgData, function ($value) {
                            return $value !== NULL;
                        })
                    );
                }else{
                    
                    $album->album_images()->create([
                        'name' => $record['name'] ?? '',
                        'img' => uploadIamge($record['image'], 'albums') // function on helper file to upload file
                    ]);
                }
            }
        }
        $album->update(['name' => $request->name]);
        return $album;
    }

    function delete($id)
    {
        $album = $this->model->find($id);
        if ($album->album_images->count()) {

            // $imagesPath = array_column($album->album_images->toArray(), 'img');
            foreach ($album->album_images as $image) {
                if (file_exists($image->img)) {
                    unlink($image->img);
                }
                $image->delete();
            }
        }
        return $album->delete();
    }

    function movePictures($request, $id)
    {

        $album = $this->model->find($id);
        $futureAlbum = $this->model->find($request->album_id);
        if ($album->album_images->count() && $futureAlbum) {
            
            foreach ($album->album_images as $image) {
                if($image->img){

                    // make new image for future album
                    $newFileName = hash('md5', pathinfo($image->img, PATHINFO_FILENAME)).'.'.pathinfo($image->img, PATHINFO_EXTENSION);
                    $destinationPath = 'admin/assets/images/albums/' . $newFileName;                    
                    File::copy($image->img, public_path($destinationPath));

                    $futureAlbum->album_images()->create([
                        'name' => $image->name ?? '',
                        'img' => $destinationPath 
                    ]);
                }
            }
        }
        if(isset($request->move_with_delete)){
            return $this->delete($album->id);
        }
        return $album;
    }
}