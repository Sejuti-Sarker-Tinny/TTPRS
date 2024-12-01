<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Division;
use App\Models\District;
use App\Models\TypesOfAttraction;

use App\Models\Spot;
use Carbon\Carbon;

use Session;
use Image;
use File;

class SpotController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){

        $all = Spot::orderBy('spot_id', 'DESC')->get();


        return view('admin.spot.all',compact('all'));
    }

    public function add(){
        return view('admin.spot.add');

    }


    public function district_under_division($divID){
        
        $allDistrict = District::where('division_id', $divID)->orderBy('district_id', 'DESC')->get();
        return response()->json($allDistrict);
    }

    public function edit($slug){
        $allData = Spot::where('spot_slug', $slug)->first();
    
        return view('admin.spot.edit', compact('allData'));
    }

    public function view($slug){
        $data = Spot::where('spot_slug', $slug)->first();
    
		return view('admin.spot.view', compact('data'));
    
    
    }


    public function submit(Request $request){
        $division_id = $request->division_id;
        
		$district_id = $request->district_id;  
    
    
        $this->validate($request,[
            'division_id'=>'required',
            'district_id'=>'required',
            'types_of_attraction_id'=>'required',
            'details'=>'required',
            'photo' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'name'=>'required|max:255|unique:spots,spot_name,NULL,NULL,spot_division_id,'.$division_id.',spot_district_id,'.$district_id.'',
        ],[
            'name.required'=>'Spot name is required.',
            'name.max'=>'This spot name must not be greater than 255 characters.',
            'name.unique'=>'This spot name has already been taken under this district & division.',
            'division_id.required'=>'Division name is required.',
            'district_id.required'=>'District name is required.',
            'types_of_attraction_id.required'=>'Types of attraction name is required.',
            'details.required'=>'Spot details is required.',
            'photo.image'=>'This file must be an image.',
            'photo.required'=>'Spot photo is required.',
        ]);
        $slug = "SPOT".uniqid();
    
    
        $insertID = Spot::insertGetId([
            'spot_name'=>$request->name,
            'spot_division_id'=>$request->division_id,
            'spot_district_id'=>$request->district_id,
            'spot_types_of_attraction_id'=>$request->types_of_attraction_id,
            'spot_details'=>$request->details,
            'spot_types_of_vehicles'=>$request->spot_types_of_vehicles,
            'spot_entry_fee'=>$request->entry_fee,
            'spot_opening_time'=>$request->opening_time,
            'spot_closing_time'=>$request->closing_time,
            'spot_map'=>$request->map,
            'spot_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('photo')){
            $image=$request->file('photo');
            $imageName='spot_'.$insertID.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/spot/'.$imageName);
            Spot::where('spot_id',$insertID)->update([
              'spot_photo'=>$imageName,
            ]);
        
        }  
        if($insertID){
            Session::flash('success','Spot successfully added!');
            return redirect()->route('all_spot');
        }else{
            Session::flash('error','Spot addition failed!');
            return redirect()->route('add_spot');
        }
    }

    public function update(Request $request){
        $spot_id = $request->id;
        $division_id = $request->division_id;
        $district_id = $request->district_id;  
        $this->validate($request,[
            'name'=>'required|max:255|unique:spots,spot_name,'.$spot_id.',spot_id,spot_division_id,'.$division_id.',spot_district_id,'.$district_id.'',
            'division_id'=>'required',
            'district_id'=>'required',
            'types_of_attraction_id'=>'required',
            'details'=>'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            //'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=500,max_height=500', // (2048kb max size limit)
        ],[
            'name.required'=>'Spot name is required.',
            'name.max'=>'This spot name must not be greater than 255 characters.',
            'name.unique'=>'This spot name has already been taken under this district & division.',
            'division_id.required'=>'Division name is required.',
            'district_id.required'=>'District name is required.',
            'types_of_attraction_id.required'=>'Types of attraction name is required.',
            'details.required'=>'Spot details is required.',
            'photo.image'=>'This file must be an image.',
        ]);
        $update = Spot::where('spot_id', $spot_id)->update([
            'spot_name'=>$request->name,
            'spot_division_id'=>$request->division_id,
            'spot_district_id'=>$request->district_id,
            'spot_types_of_attraction_id'=>$request->types_of_attraction_id,
            'spot_details'=>$request->details,
            'spot_types_of_vehicles'=>$request->spot_types_of_vehicles,
            'spot_entry_fee'=>$request->entry_fee,
            'spot_opening_time'=>$request->opening_time,
            'spot_closing_time'=>$request->closing_time,
            'spot_map'=>$request->map,
            'spot_slug'=>$request->slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('photo')){
            $image=$request->file('photo');
            $imageName='spot_'.$spot_id.'_'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(200,200)->save('uploads/spot/'.$imageName);
            Spot::where('spot_id', $spot_id)->update([
              'spot_photo'=>$imageName,
            ]);
        }  
        if($update){
            Session::flash('success','Spot successfully updated!');
            return redirect()->route('all_spot');
        }else{
            Session::flash('error','Spot edit process failed!');
        
            return redirect()->route('edit_spot');
        }
        
    }
    
    public function delete(Request $request){
        $spot = Spot::where('spot_id', $request->modal_id)->first();
        $path = 'uploads/spot/'.$spot->spot_photo;
        if(File::exists($path)){
            File::delete($path);
        } 
        $delete = Spot::where('spot_id', $request->modal_id)->delete();
        if($delete){
            Session::flash('success','Spot successfully deleted!');
            return redirect()->route('all_spot');
        }else{
            Session::flash('error','Spot delete process failed!');
            return redirect()->route('all_spot');
        }
    }

}






