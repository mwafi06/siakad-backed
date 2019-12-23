<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GeneralFacades extends Facade {
    protected static function getFacadeAccessor() { return 'general'; }
}
