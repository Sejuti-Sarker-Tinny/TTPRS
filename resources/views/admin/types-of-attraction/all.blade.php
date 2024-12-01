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
                            <h4 class="card-title"><i class="fab fa-gg-circle"></i><b> All Types of Attraction</b></h4>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Types of Attraction</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $c=1;
                        @endphp
                        @foreach($all as $data)
                        <tr>
                            <td>{{$c++}}</td>
                            <td>{{$data->types_of_attraction_name}}</td>
                            <td>
                                <a href="{{ route('edit_types_of_attraction', ['slug' => $data->types_of_attraction_slug]) }}" title="Edit"><i class="fas fa-pen-square text-dark"></i></a>
                            </td>
                        </tr>
                        @endforeach
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