@extends('layouts.dashboard')
@section('dashboard_content')
@if(Session::has('success'))
<script>
Swal.fire({
    position: 'center',
    icon: 'success',
    text: '{{Session::get('success')}}',
    toast: '',
    showConfirmButton: false,
    timer: '5000',
})
</script>
@endif
@if(Session::has('error'))
<script>
Swal.fire({
    position: 'center',
    icon: 'error',
    text: '{{Session::get('error')}}',
    toast: '',
    showConfirmButton: false,
    timer: '5000',
})
</script>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('change_password_update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i><b> Change Your Password</b></h4>
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
                <input type="hidden" name="id" value="{{$allData->id}}">
                <input type="hidden" name="slug" value="{{$allData->user_slug}}">
                <div class="form-group row mb-3 @error('current_password') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Current Password:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" name="current_password" value="" required>
                    @error('current_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('new_password') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>New Password:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" name="new_password" value="" required>
                    @error('new_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('confirm_password') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Confirm Password:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="password" class="form-control" name="confirm_password" value="" required>
                    @error('confirm_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-md btn-dark">Change Your Password</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection