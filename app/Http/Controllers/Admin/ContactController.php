<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Models\Language;
use App\Mail\ContactMail;
use App\Models\ReceivedMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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
        $messages = ReceivedMail::OrderByDesc('id')->get();
        return view('admin.contact-message.index' , compact('messages'));
    }

    public function replyMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'reply' => 'required',
        ]);

       try {
        $mailFrom = Contact::where('language' , 'en')->first();

        Mail::to($request->email)->send(new ContactMail($mailFrom->email , $request->subject , $request->reply));

        toast(__('Reply sent Successfully'), 'success');
        return redirect()->back();

       }catch (\Exception $e) {
        toast(__($e->getMessage()), 'error');
        return redirect()->back();
       }
    }
}
