<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function users()
    {
        $total_user = User::count();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin/users/users', compact('users', 'total_user'));
    }

    function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back();
    }

    function edit_profile()
    {
        return view('admin/users/edit_profile');
    }

    function update_profile(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|unique:users'
            ],
            [
                User::find(Auth::id())->update([
                    'name' => $request->name,
                ])
            ]
        );

        if ($request->new_password == '') {
            User::find(Auth::id())->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return back()->with('success', 'Profile Updated Successfully!');
        } else {

            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'name' => $request->name,
                    'password' => bcrypt($request->new_password),
                    'email' => $request->email
                ]);
                return back()->with('success', 'Profile Updated Successfully!');
            } else {
                return back()->withError('Old Password Not Match!');
            }
        }
    }

    function update_photo(Request $request)
    {
        if (Auth::user()->image == null) {
            $uploaded_file = $request->photo;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('uploads/users/' . $file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);
            return back()->with('success-img', 'Image Updated Successfully!');
        } else {
            $user_img = Auth::user()->image;
            $delete_from = public_path('/uploads/users/' . $user_img);
            unlink($delete_from);

            $uploaded_file = $request->photo;
            $extension = $uploaded_file->getClientOriginalExtension();
            $file_name = Auth::id() . '.' . $extension;
            Image::make($uploaded_file)->save(public_path('uploads/users/' . $file_name));

            User::find(Auth::id())->update([
                'image' => $file_name,
            ]);
            return back()->with('success-img', 'Image Updated Successfully!');
        }
    }
}
