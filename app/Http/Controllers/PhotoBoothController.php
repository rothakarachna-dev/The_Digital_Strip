<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sticker;

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

        public function showSticker()
    {
        $stickers = Sticker::latest()->get();
        return view('contact.sticker', compact('stickers'));
    }
    
        public function showPhoto()
    {
        return view('contact.photo');
    }
    

}
