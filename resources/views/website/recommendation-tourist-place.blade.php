@extends('layouts.website.index')
@section('contents')
@php
    $allDivision = App\Models\Division::orderBy('division_id', 'DESC')->get();
    $allTypesOfAttraction = App\Models\TypesOfAttraction::orderBy('types_of_attraction_id', 'DESC')->get();
@endphp
<div class="container recommendation_container">    
    <form method="get" action="{{url('recommendation/tourist-place')}}" enctype="multipart/form-data">
        <hr>
        <input type="hidden" id="dist_slug" value="{{$request->district_slug}}">
        <div class="row recommendation_row">
            <div class="col-md-4 recommendation_col">

                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label"><b class="recommendation_search_parameter_class">Division:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control recommendation_input_field" name="division_slug" id="division_slug">
                        <option value="">Select Division</option>
                        @foreach($allDivision as $data)
                        <option value="{{$data->division_slug}}" @if($request->division_slug==$data->division_slug) selected="selected" @endif>{{$data->division_name}}</option>
                        @endforeach
                    </select>
    
                </div>
    
            </div>
    
        </div>
            <div class="col-md-4 recommendation_col">
                <div class="form-group row mb-3">
                    <label class="col-sm-3 col-form-label"><b class="recommendation_search_parameter_class">District:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control recommendation_input_field" name="district_slug" id="district_slug">
    
                        <option value="">Select District</option>
                    </select>
        
                    </div>
                </div>
            </div>
            <div class="col-md-4 recommendation_col">
                <div class="form-group row mb-3">
                    <label class="col-sm-6 col-form-label"><b class="recommendation_search_parameter_class">Types of Attraction:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control recommendation_input_field" name="types_of_attraction_slug" id="types_of_attraction_slug">
                        <option value="">Select Attraction</option>
                        @foreach($allTypesOfAttraction as $data)
                        <option value="{{$data->types_of_attraction_slug}}" @if($request->types_of_attraction_slug==$data->types_of_attraction_slug) selected="selected" @endif>{{$data->types_of_attraction_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            </div>  
            <hr>
            <button type="submit" class="btn btn-md btn-info"><b><h5>Recommendation</h5></b></button>
        </div>
        <hr>
        @if($recommendation_parameter!=0)
        <div class="row">
        <div class="card-body">
            @foreach($spots as $spot)
            <div class="row">
                <div class="col-md-12">
    
                    <h2 class="text-center recommendation_spot_title"><b>{{$spot->spot_name}}</b></h2>
                </div>
        
            </div>
            <br>
        
            <div class="row">
                <div class="col-md-4">
        
                    <img src="{{asset('uploads/spot/'.$spot->spot_photo)}}" alt="Spot Photo" class="recommendation_img" height="190px" width="280px">
            
            
                </div>
                <div class="col-md-8">

                    <p align="justify">{{Str::limit($spot->spot_details, 750, '.....   ')}}<a href="{{ route('recommended_spot_details', ['slug' => $spot->spot_slug]) }}" class="btn btn-primary btn-sm" title="Details">Details</a></p>
                </div>
            
            
            </div>
            <br>
    
            <div class="row">
    
            <div class="col-md-4">
                    <span class="recommendation_time_fee"><b>Entry fee: </b></span>
                    <b class="recommendation_value_font_size">                            
                    @if($spot->spot_entry_fee!=NULL)
                        {{number_format($spot->spot_entry_fee)}}
                    @endif                            
                    </b>
                </div>
                <div class="col-md-4">
                    <span class="recommendation_time_fee"><b>Opening time: </b></span>
                    <b class="recommendation_value_font_size">
                    @php
                        $date = strtotime($spot->spot_opening_time);
                        if($spot->spot_opening_time!=NULL){
                            echo date('h:i A', $date);
                        }
                    @endphp
                    </b>
                </div>
                <div class="col-md-4">
                    <span class="recommendation_time_fee"><b>Closing time: </b></span>
                    <b class="recommendation_value_font_size">
                    @php
                        $date = strtotime($spot->spot_closing_time);
                        if($spot->spot_closing_time!=NULL){
                            echo date('h:i A', $date);
                        }
                    @endphp
                    </b>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <span class="recommendation_search_parameter"><b>Division: </b></span><b class="recommendation_value_font_size">{{$spot->divisionInfo->division_name}}</b>
                </div>
                <div class="col-md-4">
                    <span class="recommendation_search_parameter"><b>District: </b></span><b class="recommendation_value_font_size">{{$spot->districtInfo->district_name}}</b>
                </div>
                <div class="col-md-4">
                    <span class="recommendation_search_parameter"><b>Attraction: </b></span><b class="recommendation_value_font_size">{{$spot->typesOfAttractionInfo->types_of_attraction_name}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- @php
                    $map=$spot->spot_map;
                    echo $map;
                    @endphp -->
                </div>
            </div>
            <hr class="recommendation_hr">
            @endforeach
        </div>
        </div>
        @endif
</form>
</div>

<script>
// District under Division dependency field
$(document).ready(function(){
    $('select[id="division_slug"]').on('change',function(){
    var div_slug= $(this).val();
    if(div_slug!=''){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:"{{url('recommendation/fetch/district/under/division')}}/"+div_slug,
        success:function(data){
        $('select[id="district_slug"]').empty();
        $('select[id="district_slug"]').append('<option value="">Select District</option>');
            $.each(data, function(key, value){
                $('select[id="district_slug"]').append('<option value="'+value.district_slug+'">'+value.district_name+'</option>');
            });
        }
    });
    }else{
        $('select[id="district_slug"]').empty('');
        $('select[id="district_slug"]').append('<option value="">Select District</option>');
    }
});
});
// initial district setup under specific division
$(document).ready(function(){
    var div_slug = $('select[id="division_slug"]').val();
    var dist_slug = $('#dist_slug').val();
    if(div_slug!=''){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:"{{url('recommendation/fetch/district/under/division')}}/"+div_slug,
        success:function(data){
        $('select[id="district_slug"]').empty();
        $('select[id="district_slug"]').append('<option value="">Select District</option>');
            $.each(data, function(key, value){
                if(value.district_slug==dist_slug){
                    $('select[id="district_slug"]').append('<option value="'+value.district_slug+'" selected="selected">'+value.district_name+'</option>');
                }else{
                    $('select[id="district_slug"]').append('<option value="'+value.district_slug+'">'+value.district_name+'</option>');
                }
            });
        }
    });
    }else{
        $('select[id="district_slug"]').empty('');
        $('select[id="district_slug"]').append('<option value="">Select District</option>');
    }
});
</script>
@endsection