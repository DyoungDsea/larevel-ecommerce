<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard(){
        return view('vendor.index');
    }

    public function VendorProfile()
    {
        $id = Auth::user()->id;
        // find user by id
        $vendorData = User::find($id);

        return view('vendor.vendor_profile', compact('vendorData'));
    }

    public function VendorChangePassword()
    {
        $id = Auth::user()->id;
        // find user by id
        $vendorData = User::find($id);
        return view('vendor.vendor_change_password', compact('vendorData'));
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

    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        // find user by id
        $vendorData = User::find($id);

        $vendorData->name = $request->name;
        $vendorData->email = $request->email;
        $vendorData->phone = $request->phone;
        $vendorData->address = $request->address;
        $vendorData->vendor_join = $request->join;
        $vendorData->vendor_short_info = $request->info;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_image/' . $vendorData->photo));
            $filename = date("YmdHis") . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/vendor_image/'), $filename);
            $vendorData['photo'] = $filename;
        }

        $notification = array(
            'message' => 'Vendor profile updated successfully!',
            'alert-type' => 'success',
        );

        $vendorData->save();
        return redirect()->route('vendor.profile')->with($notification);
    }


    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    }


    public function VendorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/vendor/login');
    }
}
