<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Division;
use Carbon\Carbon;
use Session;

class DivisionController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $all = Division::orderBy('division_id', 'DESC')->get();
        return view('admin.division.all',compact('all'));
    }

    public function add(){

        return view('admin.division.add');

    }

    public function edit($slug){
        $data = Division::where('division_slug', $slug)->first();
        return view('admin.division.edit',compact('data'));
    }
    public function submit(Request $request){


        $this->validate($request,[
            'name'=>'required|max:255|unique:divisions,division_name',
        ],[
            'name.required'=>'Division name is required.',
            'name.max'=>'This division name must not be greater than 255 characters.',
            'name.unique'=>'This division name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $insert = Division::insert([
            'division_name'=>$request->name,
            'division_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($insert){
            Session::flash('success','Division name successfully added!');
            return redirect()->route('all_division');
        }else{
            Session::flash('error','Division name addition failed!');
            return redirect()->route('add_division');
        }
    
    }

    
    public function update(Request $request){

    
    
        $id = $request->id;
        $this->validate($request,[
            'name'=>'required|max:255|unique:divisions,division_name,'.$id.',division_id',
        ],[
            'name.required'=>'Division name is required.',
            'name.max'=>'This division name must not be greater than 255 characters.',
            'name.unique'=>'This division name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $update = Division::where('division_id',$id)->update([
            'division_name'=>$request->name,
            'division_slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            Session::flash('success','Division name successfully edited!');
            return redirect()->route('all_division');
        }else{
            Session::flash('error','Division name edit process failed!');
            return redirect()->route('edit_division');
        }
    }

}