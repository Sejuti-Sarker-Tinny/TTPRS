@extends('layouts.website.index')
@section('contents')
@php
    $allDivision = App\Models\Division::orderBy('division_id', 'DESC')->get();
    $allTypesOfAttraction = App\Models\TypesOfAttraction::orderBy('types_of_attraction_id', 'DESC')->get();
@endphp
<div class="container recommendation_container">
    <form method="get" action="{{url('recommendation/tourist-place')}}" enctype="multipart/form-data">
    <hr>
    <div class="row recommendation_row">
        <div class="col-md-4 recommendation_col">
            <div class="form-group row mb-3">
                <label class="col-sm-3 col-form-label"><b class="recommendation_search_parameter_class">Division:<span class="text-danger">*</span></b></label>
                <div class="col-sm-6">
                <select class="form-control recommendation_input_field" name="division_slug" id="division_slug">
                    <option value="">Select Division</option>
                    @foreach($allDivision as $data)
                    <option value="{{$data->division_slug}}">{{$data->division_name}}</option>
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
                    <option value="{{$data->types_of_attraction_slug}}">{{$data->types_of_attraction_name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-md btn-info recommendation_search_button"><b><h5>Recommendation</h5></b></button>
    </div>
    <hr>
    <div class="row">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <!-- @php
                $map = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235581.75640583446!2d92.05272257221941!3d22.692348897888376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad4b6b58d1ee59%3A0x21e5fefae772aac5!2z4KaV4Ka-4Kaq4KeN4Kak4Ka-4KaHIOCmueCnjeCmsOCmpg!5e0!3m2!1sbn!2sbd!4v1637475615295!5m2!1sbn!2sbd';   
                @endphp
                <iframe src="@php echo $map; @endphp" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>                 -->
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
