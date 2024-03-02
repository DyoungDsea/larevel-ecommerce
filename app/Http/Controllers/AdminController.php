<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        // find user by id
        $adminData = User::find($id);

        return view('admin.admin_profile', compact('adminData'));
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        // find user by id
        $adminData = User::find($id);
        return view('admin.admin_change_password', compact('adminData'));
    }
    
    public function StoreChangePassword(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'pass' => 'required',
            'cpass' => 'required|same:pass',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->pass);
            $user->save();
            $message = 'Password updated successfully!';
            $status = 'status';
        } else {
            $status = 'error';
            $message = 'Old password doesn\'t match!';
        }


        // session()->flash('message', $message);
        return back()->with($status, $message);
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        // find user by id
        $adminData = User::find($id);

        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/' . $adminData->photo));
            $filename = date("YmdHis") . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_image/'), $filename);
            $adminData['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Admin profile updated successfully!',
            'alert-type' => 'success',
        );

        $adminData->save();
        return redirect()->route('admin.profile')->with($notification);
    }


    public function AdminLogin()
    {
        return view('admin.admin_login');
    }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/admin/login');
    }
}
