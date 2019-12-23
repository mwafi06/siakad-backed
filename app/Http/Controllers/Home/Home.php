<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index()
    {
        /*
         * set view data
         */
        $this->viewData['page'] = 'Home';
        $this->viewData['content'] = 'home';

        return view($this->themes,$this->viewData);
    }
}
