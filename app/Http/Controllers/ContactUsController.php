<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use Carbon\Carbon;
use Session;

class ContactUsController extends Controller{
    public function __construct(){
                
    }
    
    public function index(){
        $all = ContactUs::orderBy('contact_id', 'DESC')->get();
        return view('admin.contact-us.all',compact('all'));
    }

    public function view($slug){
        $data = ContactUs::where('contact_slug', $slug)->first();
        return view('admin.contact-us.view', compact('data'));
    }

    public function submit(Request $request){
        $slug = "CONTACT".uniqid();
        $insert = ContactUs::insert([
            'contact_name'=>$request->name,
            'contact_no'=>$request->mobile,
            'contact_email'=>$request->email,
            'contact_message'=>$request->message,
            'contact_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            Session::flash('success','Message successfully send!');
            return redirect()->route('website');
        }else{
            Session::flash('error','Message sending failed!');
            return redirect()->route('website');
        }
    }
    
    public function delete(Request $request){
        $delete = ContactUs::where('contact_id', $request->modal_id)->delete();
        if($delete){
            Session::flash('success','Message successfully deleted!');
            return redirect()->route('all_contact');
        }else{
            Session::flash('error','Message delete process failed!');
            return redirect()->route('all_contact');
        }
    }

    
}
