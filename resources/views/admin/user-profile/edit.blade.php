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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('update_user_profile') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i><b> Update Your Profile</b></h4>
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
                <div class="form-group row mb-3 @error('name') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Name:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="{{$allData->name}}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('email') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Email:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="{{$allData->email}}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('phone') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Phone:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="{{$allData->phone}}" required>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('photo') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Photo:</b></label>
                    <div class="col-sm-6">
                    <input type="file" onchange="readURL(this);" class="form-control" name="photo" value="{{$allData->photo}}">
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    @if($allData->photo!='')
                    <img id="user_photo_preview" src="{{asset('uploads/user/'.$allData->photo)}}" alt="User photo" height="100px" width="100px"/>
                    @else
                    <img id="user_photo_preview" src="{{asset('contents/admin/assets/img/avatar.png')}}" alt="" height="100px" width="100px"/>
                    @endif
                    </div>
                </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-md btn-dark">Update Your Profile</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection