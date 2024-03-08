<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Language;
use App\Models\Subscriber;
use App\Models\ReceivedMail;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::where(['status' => 1 , 'is_approved' => 1])->count();
        $notApprovedNews = News::where(['status' => 1 , 'is_approved' => 0])->count();
        $totalSubscriber = Subscriber::count();
        $activeLanguages = Language::where('status' , 1)->count();
        $totalContactMessages = ReceivedMail::count();
        $unseenContactMessages = ReceivedMail::where('seen' , 0)->count();
        $unRepliedContactMessages = ReceivedMail::where('replied' , 0)->count();
        $totalRoles = Role::count();
        return view('admin.dashboard.index', compact(
            'totalNews',
            'notApprovedNews',
            'totalSubscriber',
            'activeLanguages',
            'totalContactMessages',
            'unseenContactMessages',
            'unRepliedContactMessages',
            'totalRoles'
        ));
    }
}
