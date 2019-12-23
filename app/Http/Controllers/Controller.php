<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $themes;

    public $viewData;

    public $user;

    public $limit = 50;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->themes = general()->themes;
            $this->viewData = general()->viewData();
            $this->user = general()->activeUser();
            return $next($request);
        });
    }
}
