@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title"><i class="fab fa-gg-circle"></i><b> View Spot</b></h4>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dt-responsive view_table">
                        <thead class="thead-dark">
                        </thead>
                        <tbody>
                        <tr>
                        <td><b>Spot</b></td>
                        <td>:</td>
                        <td>{{$data->spot_name}}</td>
                        </tr>
                        <tr>
                        <td><b>Division</b></td>
                        <td>:</td>
                        <td>{{$data->divisionInfo->division_name}}</td>
                        </tr>
                        <tr>
                        <td><b>District</b></td>
                        <td>:</td>
                        <td>{{$data->districtInfo->district_name}}</td>
                        </tr>
                        <tr>
                        <td><b>Types of Attraction</b></td>
                        <td>:</td>
                        <td>{{$data->typesOfAttractionInfo->types_of_attraction_name}}</td>
                        </tr>
                        <tr>
                        <td><b>Details</b></td>
                        <td>:</td>
                        <td>{{$data->spot_details}}</td>
                        </tr>
                        <tr>
                        <td><b>Types of Vehicles</b></td>
                        <td>:</td>
                        <td>{{$data->spot_types_of_vehicles}}</td>
                        </tr>
                        <tr>
                        <td><b>Entry fee</b></td>
                        <td>:</td>
                        <td>
                            @if($data->spot_entry_fee!=NULL)
                                {{number_format($data->spot_entry_fee)}}
                            @endif                            
                        </td>
                        </tr>
                        <tr>
                        <td><b>Opening time</b></td>
                        <td>:</td>
                        <td>
                            @php
                                $date = strtotime($data->spot_opening_time);
                                if($data->spot_opening_time!=NULL){
                                    echo date('h:i A', $date);
                                }
                            @endphp
                        </td>
                        </tr>
                        <tr>
                        <td><b>Closing time</b></td>
                        <td>:</td>
                        <td>
                            @php
                                $date = strtotime($data->spot_closing_time);
                                if($data->spot_closing_time!=NULL){
                                    echo date('h:i A', $date);
                                }
                            @endphp
                        </td>
                        </tr>
                        <tr>
                        <td><b>Photo</b></td>
                        <td>:</td>
                        <td><img src="{{asset('uploads/spot/'.$data->spot_photo)}}" height="100px" width="160px"></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection