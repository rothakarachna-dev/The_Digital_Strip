<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sticker;

class PhotoBoothController extends Controller
{
    public function showLayout()
    {
        return view('user.layout');
    }
 
    public function showCamera()
    {
        return view('user.camera');
    }

        public function showSticker()
    {
        $stickers = Sticker::latest()->get();
        return view('user.sticker', compact('stickers'));
    }
    
        public function showPhoto()
    {
        return view('user.photo');
    }
    

}
