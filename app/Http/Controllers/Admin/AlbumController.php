<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\AlbumRepository;
use App\Http\Requests\Admin\AlbumRequests\AlbumStoreRequest;
use App\Http\Requests\Admin\AlbumRequests\AlbumUpdateRequest;

class AlbumController extends Controller
{

    public $albums;

    public function __construct(AlbumRepository $albums)
    {
        $this->albums = $albums;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->albums->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->albums->create();
    }

    public function store(AlbumStoreRequest $request)
    {
        try{
            $this->albums->store($request);
            // $this->albums->storeWithRelations($request, 'album_images', $request->images ? $request->images : []);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->albums->edit($id);
    }

    public function update(AlbumUpdateRequest $request, $id)
    {
        try{
            $this->albums->update($request, $id);
            // $this->albums->updateWithRelations($request, $id, 'album_images', $request->images ? $request->images : []);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function activate(Request $request)
    {
        try{
            $this->albums->activate($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function delete(Request $request)
    {
        try{
            // $this->albums->delete($request->record_id); // this make soft delete
            // $this->albums->removeRecord($request->record_id); // this make final delete
            $this->albums->deleteWithImages($request->record_id); // this make final delete and delete sub images
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->albums->search($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->albums->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->albums->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->albums->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->albums->archivesSearch($request);
    }


    public function back(Request $request)
    {
        try{
            $this->albums->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function movePictures(Request $request, $id)
    {
        try{
            $this->albums->movePictures($request, $id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}