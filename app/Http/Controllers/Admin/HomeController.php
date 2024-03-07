<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\Admin\AlbumRepository;
use App\Http\Repositories\Eloquent\Admin\HomeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $home;
    public $albumRepository;

    public function __construct(HomeRepository $home, AlbumRepository $albumRepository)
    {
        $this->home = $home;
        $this->albumRepository = $albumRepository;
    }

    public function home()
    {
        return $this->home->home();
    }

    public function albums(Request $request)
    {
        return $this->albumRepository->search($request);
    }

}
