@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title"><i class="fab fa-gg-circle"></i><b> View Contact Message</b></h4>
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
                        <td><b>Name</b></td>
                        <td>:</td>
                        <td>{{$data->contact_name}}</td>
                        </tr>
                        <tr>
                        <td><b>Mobile</b></td>
                        <td>:</td>
                        <td>{{$data->contact_no}}</td>
                        </tr>
                        <tr>
                        <td><b>Email</b></td>
                        <td>:</td>
                        <td>{{$data->contact_email}}</td>
                        </tr>
                        <tr>
                        <td><b>Message</b></td>
                        <td>:</td>
                        <td>{{$data->contact_message}}</td>
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