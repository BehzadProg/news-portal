<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Language;
use App\Models\ReceivedMail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $languages = Language::where('status' , 1)->get();
        return view('admin.contact-page.index' , compact('languages'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required|max:500',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:60',
        ]);

        Contact::updateOrCreate(
            ['language' => $request->language],
            [
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]
        );

        toast(__('Updated Successfully') , 'success');
        return redirect()->back();
    }

    public function contactMessage()
    {
        $messages = ReceivedMail::all();
        return view('admin.contact-message.index' , compact('messages'));
    }
}
