@extends('layouts.dashboard')
@section('dashboard_content')
@if(Session::has('success'))
<script>
Swal.fire({
    position: 'top-end',
    icon: 'success',
    text: '{{Session::get('success')}}',
    toast: 'true',
    showConfirmButton: false,
    timer: '5000',
})
</script>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title"><i class="fab fa-gg-circle"></i><b> My Profile Information</b></h4>
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
                        <td>{{$data->name}}</td>
                        </tr>
                        <tr>
                        <td><b>Email</b></td>
                        <td>:</td>
                        <td>{{$data->email}}</td>
                        </tr>
                        <tr>
                        <td><b>Phone</b></td>
                        <td>:</td>
                        <td>{{$data->phone}}</td>
                        </tr>
                        <tr>
                        <td><b>Photo</b></td>
                        <td>:</td>
                        <td>            
                        @if($data->photo!='')
                        <img src="{{asset('uploads/user/'.$data->photo)}}" height="100px" width="100px" alt="User photo">
                        @endif
                        </td>
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