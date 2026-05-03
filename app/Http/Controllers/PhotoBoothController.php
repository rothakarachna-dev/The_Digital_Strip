<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoBoothController extends Controller
{
    public function showLayout()
    {
        return view('contact.layout');
    }
 
    public function showCamera()
    {
        return view('contact.camera');
    }
}
