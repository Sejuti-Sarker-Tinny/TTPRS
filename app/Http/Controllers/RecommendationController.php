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

class RecommendationController extends Controller{
    public function __construct(){
        
    }

    public function index(){
        return view('website.recommendation-search');
    }

    public function district_under_division($divSlug){
        $divID = Division::where('division_slug', $divSlug)->value('division_id');
        $allDistrict = District::where('division_id', $divID)->orderBy('district_id', 'DESC')->get();
        return response()->json($allDistrict);
    }

    public function recommendation(Request $request){
        $division = $request->division_slug;
        $district = $request->district_slug;
        $attraction = $request->types_of_attraction_slug;
        $div_id = Division::where('division_slug', $division)->value('division_id');
        $dist_id = District::where('district_slug', $district)->value('district_id');
        $attract_id = TypesOfAttraction::where('types_of_attraction_slug', $attraction)->value('types_of_attraction_id');
        $recommendation_parameter = 1;
        if($division=='' && $district=='' && $attraction==''){
            $recommendation_parameter = 0;
            return view('website.recommendation-tourist-place', compact('request','recommendation_parameter'));
        }elseif($division!='' && $district=='' && $attraction==''){
            $spots = Spot::where('spot_division_id', $div_id)->get();
            return view('website.recommendation-tourist-place', compact('request','spots','recommendation_parameter'));
        }elseif($division!='' && $district!='' && $attraction==''){
            $spots = Spot::where('spot_division_id', $div_id)->where('spot_district_id', $dist_id)->get();
            return view('website.recommendation-tourist-place', compact('request','spots','recommendation_parameter'));
        }elseif($division!='' && $district!='' && $attraction!=''){
            $spots = Spot::where('spot_division_id', $div_id)->where('spot_district_id', $dist_id)->where('spot_types_of_attraction_id', $attract_id)->get();
            return view('website.recommendation-tourist-place', compact('request','spots','recommendation_parameter'));
        }elseif($division!='' && $district=='' && $attraction!=''){
            $spots = Spot::where('spot_division_id', $div_id)->where('spot_types_of_attraction_id', $attract_id)->get();
            return view('website.recommendation-tourist-place', compact('request','spots','recommendation_parameter'));
        }elseif($division=='' && $district=='' && $attraction!=''){
            $spots = Spot::where('spot_types_of_attraction_id', $attract_id)->get();
            return view('website.recommendation-tourist-place', compact('request','spots','recommendation_parameter'));
        }
    }

    public function details($slug){

        $spot = Spot::where('spot_slug', $slug)->first();
        return view('website.recommended-spot-details', compact('spot'));
    }

    public function review_rating_submit(Request $request){

        $spot_id = $request->id;
        $comfortable_rating_point = $request->star_first_rating;
        $safe_rating_point = $request->star_second_rating;
        $spot = Spot::where('spot_id', $spot_id)->first();
        $spot_number_of_total_ratings = $spot->spot_number_of_total_ratings+1;
        $total_comfortable_rating_point = $spot->spot_comfortable_total_rating_point+$comfortable_rating_point;
        $total_safe_rating_point = $spot->spot_safe_total_rating_point+$safe_rating_point;
        $update = Spot::where('spot_id', $spot_id)->update([
            'spot_number_of_total_ratings'=>$spot_number_of_total_ratings,
            'spot_comfortable_total_rating_point'=>$total_comfortable_rating_point,
            'spot_safe_total_rating_point'=>$total_safe_rating_point,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $review_no = $spot_number_of_total_ratings;
        $comfortable_rating = number_format($total_comfortable_rating_point/$review_no,1);
        $safe_rating = number_format($total_safe_rating_point/$review_no,1);
        if($update){
            return response()->json(['success'=>'Spot Reviewed Successfully.',
                                        'total_review'=>$review_no,
                                        'comfortable_rating'=>$comfortable_rating,
                                        'safe_rating'=>$safe_rating,
                                    ]);
        }else{
            return response()->json(['fail'=>'0']);
        }

    }

}
