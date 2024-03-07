<?php

namespace App\Http\ServicesLayer\Admin\AlbumServices;

use App\Models\Album;

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
                
                $album->album_images()->create([
                    'name' => $record['name'] ?? '',
                    'img' => uploadIamge($record['image'], 'albums') // function on helper file to upload file
                ]);
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

            $imagesPath = array_column($album->album_images->toArray(), 'img');
            foreach ($imagesPath as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
        return $album->delete();
    }
}