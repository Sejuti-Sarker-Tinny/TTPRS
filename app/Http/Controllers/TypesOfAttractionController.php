<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TypesOfAttraction;
use Carbon\Carbon;
use Session;

class TypesOfAttractionController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $all = TypesOfAttraction::orderBy('types_of_attraction_id', 'DESC')->get();
        return view('admin.types-of-attraction.all',compact('all'));
    }

    public function add(){
        return view('admin.types-of-attraction.add');
    }

    public function edit($slug){
        $data = TypesOfAttraction::where('types_of_attraction_slug', $slug)->first();
        return view('admin.types-of-attraction.edit',compact('data'));
    }

    public function submit(Request $request){
        $this->validate($request,[
            'name'=>'required|max:255|unique:types_of_attractions,types_of_attraction_name',
        ],[
            'name.required'=>'Types of attraction name is required.',
            'name.max'=>'This types of attraction name must not be greater than 255 characters.',
            'name.unique'=>'This types of attraction name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $insert = TypesOfAttraction::insert([
            'types_of_attraction_name'=>$request->name,
            'types_of_attraction_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            Session::flash('success','Types of attraction name successfully added!');
            return redirect()->route('all_types_of_attraction');
        }else{
            Session::flash('error','Types of attraction name addition failed!');
            return redirect()->route('add_types_of_attraction');
        }
    }

    public function update(Request $request){
        $id = $request->id;
        $this->validate($request,[
            'name'=>'required|max:255|unique:types_of_attractions,types_of_attraction_name,'.$id.',types_of_attraction_id',
        ],[
            'name.required'=>'Types of attraction name is required.',
            'name.max'=>'This types of attraction name must not be greater than 255 characters.',
            'name.unique'=>'This types of attraction name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $update = TypesOfAttraction::where('types_of_attraction_id',$id)->update([
            'types_of_attraction_name'=>$request->name,
            'types_of_attraction_slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            Session::flash('success','Types of attraction name successfully edited!');
            return redirect()->route('all_types_of_attraction');
        }else{
            Session::flash('error','Types of attraction name edit process failed!');
            return redirect()->route('edit_types_of_attraction');
        }
    }    
}
