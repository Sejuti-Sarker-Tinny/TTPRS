<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Division;
use App\Models\District;
use Carbon\Carbon;
use Session;

class DistrictController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $all = District::orderBy('district_id', 'DESC')->get();
        return view('admin.district.all',compact('all'));
    }

    public function add(){
        return view('admin.district.add');
    }

    public function edit($slug){
        $data = District::where('district_slug', $slug)->first();
        return view('admin.district.edit',compact('data'));
    }
    public function submit(Request $request){
        $this->validate($request,[
            'name'=>'required|max:255|unique:districts,district_name',
        ],[
            'name.required'=>'District name is required.',
            'name.max'=>'This district name must not be greater than 255 characters.',
            'name.unique'=>'This district name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $insert = District::insert([
            'district_name'=>$request->name,
            'district_slug'=>$slug,
            'division_id'=>$request->division_id,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            Session::flash('success','District name successfully added!');
            return redirect()->route('all_district');
        }else{
            Session::flash('error','District name addition failed!');
            return redirect()->route('add_district');
        }
    }

    public function update(Request $request){
        $id = $request->id;
        $this->validate($request,[
            'name'=>'required|max:255|unique:districts,district_name,'.$id.',district_id',
        ],[
            'name.required'=>'District name is required.',
            'name.max'=>'This district name must not be greater than 255 characters.',
            'name.unique'=>'This district name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $update = District::where('district_id',$id)->update([
            'district_name'=>$request->name,
            'district_slug'=>$slug,
            'division_id'=>$request->division_id,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            Session::flash('success','District name successfully edited!');
            return redirect()->route('all_district');
        }else{
            Session::flash('error','District name edit process failed!');
            return redirect()->route('edit_district');
        }
    }
}
