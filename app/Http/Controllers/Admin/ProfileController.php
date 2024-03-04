<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;
use App\Models\Admin;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
Use Alert;

class ProfileController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        $profile = Admin::findOrFail($id);
        $imagePath = $this->handleUpload('image' , $profile , env('ADMIN_PROFILE_IMAGE_UPLOAD_PATH') , 'admin_profile');

        $profile->image = (!empty($imagePath) ? $imagePath : $profile->image);
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->save();

        toast(__('admin_localize.Profile Updated Successfully!'),'success')->width('400');
        return redirect()->back();
    }

    public function updatePassword(AdminUpdatePasswordRequest $request , string $id)
    {

        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();

        toast(__('admin_localize.Password Updated Successfully!'),'success')->width('400');
        return redirect()->back();
    }
}
