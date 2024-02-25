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
    public function __construct()
    {
        $this->middleware(['permission:contact index,admin'])->only('index');
        $this->middleware(['permission:contact update,admin'])->only('update');
        $this->middleware(['permission:contact message index,admin'])->only(['contactMessage' , 'replyMessage']);
        $this->middleware(['permission:contact message delete,admin'])->only('destroyMessage');
    }
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
        $unReadMessages = ReceivedMail::where('seen' , 0)->count();
        return view('admin.contact-message.index' , compact('messages' , 'unReadMessages'));
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

        $didReplied = ReceivedMail::find($request->message_id);
        $didReplied->replied = 1;
        $didReplied->save();

        toast(__('Reply sent Successfully'), 'success');
        return redirect()->back();

       }catch (\Exception $e) {
        toast(__($e->getMessage()), 'error');
        return redirect()->back();
       }
    }

    public function destroyMessage(Request $request) {
        $receivedMessage = ReceivedMail::findOrFail($request->id);

        $receivedMessage->delete();

        return response(['status' => 'success' , 'message' => __('Message Deleted Successfully')]);
    }

    public function hasSeen(Request $request) {
        $seen = ReceivedMail::findOrFail($request->id);
        if($seen->seen == 0){
            $seen->seen = 1;
            $seen->save();
            return response(['status' => 'success' , 'message' => __('Seen')]);
        }elseif($seen->seen == 1){

            return response(['status' => 'info' , 'message' => __('You have seen this mail massege before')]);
        }

    }
}
