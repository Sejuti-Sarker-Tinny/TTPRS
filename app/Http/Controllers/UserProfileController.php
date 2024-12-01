<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Image;
use File;
use Auth;

class UserProfileController extends Controller{    
    public function __construct(){
        $this->middleware('auth');
    }

    public function view($slug){
        $data = User::where('user_slug', $slug)->first();
        return view('admin.user-profile.view', compact('data'));
    }

    public function edit($slug){
        $allData = User::where('user_slug', $slug)->first();
        return view('admin.user-profile.edit', compact('allData'));
    }

    public function update(Request $request){
        $user_id = $request->id;
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required',
            'phone'=>'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            //'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=500,max_height=500', // (2048kb max size limit)
        ],[
            'name.required'=>'Your name is required.',
            'name.max'=>'Your name must not be greater than 255 characters.',
            'email.required'=>'Email is required.',
            'phone.required'=>'Phone is required.',
            'photo.image'=>'This file must be an image.',
        ]);
        $update = User::where('id', $user_id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'user_slug'=>$request->slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('photo')){
            $image=$request->file('photo');
            $imageName='user_'.$user_id.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/user/'.$imageName);
            User::where('id', $user_id)->update([
              'photo'=>$imageName,
            ]);
        } 
        if($update){
            Session::flash('success','Profile successfully updated!');
            return redirect()->route('view_user_profile', ['slug' => Auth::user()->user_slug]);
        }else{
            Session::flash('error','Profile edit process failed!');
            return redirect()->route('edit_user_profile', ['slug' => Auth::user()->user_slug]);
        }
    }

    public function change_password($slug){
        $allData = User::where('user_slug', $slug)->first();
        return view('admin.user-profile.password-change', compact('allData'));
    }

    public function change_password_update(Request $request){
        $user_id = $request->id;
        $this->validate($request,[
            'current_password'=>'required|max:255',
            'new_password'=>'required|max:255',
            'confirm_password'=>'required|max:255',
        ],[
            'current_password.required'=>'Current password is required.',
            'current_password.max'=>'Current password must not be greater than 255 characters.',
            'new_password.required'=>'New password is required.',
            'new_password.max'=>'New password must not be greater than 255 characters.',
            'confirm_password.required'=>'Confirm password is required.',
            'confirm_password.max'=>'Confirm password must not be greater than 255 characters.',
        ]);
        $pass = User::where('id', $user_id)->value('password');
        //Hash::check() has two parameters first one is plane password and another is hashed password.
        //If password matched with hash it will return true
        if(Hash::check($request->current_password, $pass)==1){
            if($request->new_password==$request->confirm_password){
                $update = User::where('id', $user_id)->update([
                    'password'=>Hash::make($request->new_password),
                    'updated_at'=>Carbon::now()->toDateTimeString(),
                ]);
                if($update){
                    Session::flash('success','Password changed successfully!');
                    return redirect()->route('change_password', ['slug' => Auth::user()->user_slug]);
                }else{
                    Session::flash('error','Password change process failed!');
                    return redirect()->route('change_password', ['slug' => Auth::user()->user_slug]);
                }
            }else{
                Session::flash('error','Confirm password did not match!');
                return redirect()->route('change_password', ['slug' => Auth::user()->user_slug]);
            } 
        }else{
            Session::flash('error','Current password is wrong!');
            return redirect()->route('change_password', ['slug' => Auth::user()->user_slug]);
        }
        
    }






}


