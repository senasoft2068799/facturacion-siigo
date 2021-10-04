<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;

class CiudadeController extends Controller
{
    public function index()
    {
        return Ciudade::all()->toArray();
    }
}
