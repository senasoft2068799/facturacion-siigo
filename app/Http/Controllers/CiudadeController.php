<?php

namespace App\Http\Controllers;

use App\Models\Ciudade;
use Illuminate\Http\Request;

class CiudadeController extends Controller
{
    public function index()
    {
        return Ciudade::all()->toArray();
    }
}
