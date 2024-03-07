<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\Admin\HomeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $home;

    public function __construct(HomeRepository $home)
    {
        $this->home = $home;
    }

    public function home()
    {
        return $this->home->home();
    }
}
