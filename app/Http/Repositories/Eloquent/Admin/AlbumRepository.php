<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Models\Album;
use App\Http\Repositories\AbstractRepository;
use App\Http\ServicesLayer\Admin\AlbumServices\AlbumService;

class AlbumRepository extends AbstractRepository
{

    protected $model;
    protected $albumServices;

    public function __construct(Album $model, AlbumService $albumServices)
    {
        $this->model = $model;
        $this->albumServices = $albumServices;
    }

    public function crudName(): string
    {
        return 'albums';
    }

    public function index($offset, $limit)
    {
        $albums = $this->pagination($offset, $limit);
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store($request)
    {
        return $this->albumServices->store($request);
    }

    public function edit($id)
    {
        $album = $this->findOne($id);
        return view('admin.albums.update', compact('album'));
    }

    public function update($request, $id)
    {
        return $this->albumServices->update($request, $id);
    }

    public function archivesPage($offset, $limit)
    {
        $albums = $this->archives($offset, $limit);
        return view('admin.albums.archives', compact('albums'));
    }

    function deleteWithImages($id)
    {
        return $this->albumServices->delete($id);
    }

}