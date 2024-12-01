@extends('layouts.dashboard')
@section('dashboard_content')
@if(Session::has('error'))
<script>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    text: '{{Session::get('error')}}',
    toast: 'true',
    showConfirmButton: false,
    timer: '5000',
})
</script>
@endif
@php
    $allDivision = App\Models\Division::orderBy('division_id', 'DESC')->get();
    $allTypesOfAttraction = App\Models\TypesOfAttraction::orderBy('types_of_attraction_id', 'DESC')->get();
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('update_spot') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i><b> Edit Spot</b></h4>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <input type="hidden" name="id" value="{{$allData->spot_id}}">
                <input type="hidden" name="slug" value="{{$allData->spot_slug}}">
                <input type="hidden" id="dist_id" value="{{$allData->spot_district_id}}">
                <div class="form-group row mb-3 @error('name') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Spot:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="{{$allData->spot_name}}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('division_id') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Division:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control" name="division_id" id="division_id" required>
                        <option value="">Select Division</option>
                        @foreach($allDivision as $data)
                        <option value="{{$data->division_id}}" @if($data->division_id==$allData->spot_division_id) selected="selected" @endif>{{$data->division_name}}</option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('district_id') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>District:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control" name="district_id" id="district_id" required>
                        <option value="">Select District</option>
                    </select>
                    @error('district_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('types_of_attraction_id') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Types of Attraction:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control" name="types_of_attraction_id" id="types_of_attraction_id" required>
                        <option value="">Select Types of Attraction</option>
                        @foreach($allTypesOfAttraction as $data)
                        <option value="{{$data->types_of_attraction_id}}" @if($data->types_of_attraction_id==$allData->spot_types_of_attraction_id) selected="selected" @endif>{{$data->types_of_attraction_name}}</option>
                        @endforeach
                    </select>
                    @error('types_of_attraction_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('details') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Details:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <textarea class="form-control" name="details" rows="3" cols="12" required>{{$allData->spot_details}}</textarea>
                    @error('details')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('spot_types_of_vehicles') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Types of Vehicles:</b></label>
                    <div class="col-sm-6">
                    <textarea class="form-control" name="spot_types_of_vehicles" rows="3" cols="12">{{$allData->spot_types_of_vehicles}}</textarea>
                    @error('spot_types_of_vehicles')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('entry_fee') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Entry Fee:</b></label>
                    <div class="col-sm-6">
                    <input type="number" class="form-control" name="entry_fee" value="{{$allData->spot_entry_fee}}">
                    @error('entry_fee')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('opening_time') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Opening Time:</b></label>
                    <div class="col-sm-6">
                    <input type="time" class="form-control" name="opening_time" value="{{$allData->spot_opening_time}}">
                    @error('opening_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('closing_time') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Closing Time:</b></label>
                    <div class="col-sm-6">
                    <input type="time" class="form-control" name="closing_time" value="{{$allData->spot_closing_time}}">
                    @error('closing_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('map') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Map:</b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="map" value="{{$allData->spot_map}}">
                    @error('map')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('photo') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Photo:</b></label>
                    <div class="col-sm-6">
                    <input type="file" onchange="readURL(this);" class="form-control" name="photo" value="{{$allData->spot_photo}}">
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <img id="spot_photo_preview" src="#" alt=""/>
                    </div>
                </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-md btn-dark">Edit Spot</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
// // District under Division dependency field
// $(document).ready(function(){
//     $('select[id="division_id"]').on('change',function(){
//     var div_id= $(this).val();
//     if(div_id!=''){
//     $.ajax({
//         type:"GET",
//         dataType:"json",
//         url:"{{url('dashboard/spot/add/district/under/division')}}/"+div_id,
//         success:function(data){
//         $('select[id="district_id"]').empty();
//         $('select[id="district_id"]').append('<option value="">Select District</option>');
//             $.each(data, function(key, value){
//                 $('select[id="district_id"]').append('<option value="'+value.district_id+'">'+value.district_name+'</option>');
//             });
//         }
//     });
//     }else{
//         $('select[id="district_id"]').empty('');
//         $('select[id="district_id"]').append('<option value="">Select District</option>');
//     }
// });
// });
// initial district setup under specific division
$(document).ready(function(){
    var div_id = $('select[id="division_id"]').val();
    var dist_id = $('#dist_id').val();
    if(div_id!=''){
    $.ajax({
        type:"GET",
        dataType:"json",
        url:"{{url('dashboard/spot/add/district/under/division')}}/"+div_id,
        success:function(data){
        $('select[id="district_id"]').empty();
        $('select[id="district_id"]').append('<option value="">Select District</option>');
            $.each(data, function(key, value){
                if(value.district_id==dist_id){
                    $('select[id="district_id"]').append('<option value="'+value.district_id+'" selected="selected">'+value.district_name+'</option>');
                }else{
                    $('select[id="district_id"]').append('<option value="'+value.district_id+'">'+value.district_name+'</option>');
                }
            });
        }
    });
    }else{
        $('select[id="district_id"]').empty('');
        $('select[id="district_id"]').append('<option value="">Select District</option>');
    }
});
</script>
@endsection