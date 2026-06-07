<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    // SHOW ALL MESSAGES
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();

        return view('admin.contact', compact('messages'));
    }

    // DELETE MESSAGE
    public function destroy($id)
    {
        ContactMessage::where('id', $id)->delete();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Message deleted successfully.');
    }
}