<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Language;

class LanguagesController extends Controller
{

    public function index()
    {
        return Language::all();
    }
}
