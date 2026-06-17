<?php

namespace App\Http\Controllers;

use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StickerController extends Controller
{
    public function index()
    {
        $stickers = Sticker::latest()->get();

        return view('admin.sticker', compact('stickers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sticker_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $file = $request->file('sticker_image');

        $filename = 'sticker_' . uniqid() . '.' .
                    $file->getClientOriginalExtension();

        $file->move(public_path('Images/stickers'), $filename);

        Sticker::create([
            'image_path' => 'Images/stickers/' . $filename
        ]);

        return back()->with('success', 'Sticker uploaded!');
    }

    public function destroy($id)
    {
        $sticker = Sticker::findOrFail($id);

        $filePath = public_path($sticker->image_path);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $sticker->delete();

        return back()->with('success', 'Sticker removed!');
    }
}
