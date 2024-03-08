<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subscriber;
use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:subscriber index,admin'])->only('index');
        $this->middleware(['permission:subscriber delete,admin'])->only('destroy');
    }

    public function index()
    {
        $subs = Subscriber::orderByDesc('id')->get();
        return view('admin.subscriber.index' , compact('subs'));
    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:200',
            'message' => 'required'
        ]);

        $subscribers = Subscriber::pluck('email')->toArray();

        Mail::to($subscribers)->send(new NewsletterMail($request->subject , $request->message));

        toast()->success(__('admin_localize.Mail Sent Successfully'));
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        Subscriber::findOrFail($id)->delete();
        return response(['status' => 'success' , 'message' => __('admin_localize.Deleted Successfully')]);
    }
}
