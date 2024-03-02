<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Mail\RoleUserCreateMail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class RoleUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access management index,admin'])->only('index');
        $this->middleware(['permission:access management create,admin'])->only(['create' , 'store']);
        $this->middleware(['permission:access management update,admin'])->only(['edit' , 'update']);
        $this->middleware(['permission:access management delete,admin'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $admins = Admin::all();
        return view('admin.role-user.index' , compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $roles = Role::all();
        return view('admin.role-user.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:admins,name',
            'email' => 'required|max:255|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
        ]);

        try {
            $user = new Admin();
            $user->image = '';
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            $user->save();

            $user->assignRole($request->role);

            Mail::to($request->email)->send(new RoleUserCreateMail($request->email,$request->password));

            toast(__('User with role created successfully') , 'success');
            return redirect()->route('admin.role-users.index');
        } catch (\Throwable $th) {
            throw $th;
        }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.role-user.edit' , compact('admin' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->has('password') && !empty($request->password)){
            $request->validate([
                'password' => 'min:8|confirmed'
            ]);
        }
        $request->validate([
            'name' => 'required|max:255|unique:admins,name,'.$id,
            'email' => 'required|max:255|email|unique:admins,email,'.$id,
            'role' => 'required',
        ]);

            $user = Admin::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->has('password') && !empty($request->password)){

                $user->password = bcrypt($request->password);
            }
            $user->save();

            $user->syncRoles($request->role);


            toast(__('Updated Successfully') , 'success');
            return redirect()->route('admin.role-users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        $user = Admin::findOrFail($id);
        if($user->getRoleNames()->first() == 'Super Admin'){
            return response(['status' => 'error' , 'message' => 'You Can\'t Delete The Super User']);
        }
        $user->delete();

        return response(['status' => 'success' , 'message' => 'Deleted Successfully']);
    }
}
