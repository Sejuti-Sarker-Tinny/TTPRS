@extends('layouts.website.index')
@section('contents')
@if(Session::has('success'))
<script>
Swal.fire({
    position: 'center',
    icon: 'success',
    text: '{{Session::get('success')}}',
    toast: '',
    showConfirmButton: false,
    timer: '2000',
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
    timer: '2000',
})
</script>
@endif
<!-- Slider Start -->
<!-- banner -->
<div id="section-1" class="section">
    <div id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
        <li>
            <div class="container-fluid">
                <div class="row">
                    <img src="{{asset('contents/admin/assets')}}/img/kaptai_lake.jpg" width="100%" alt="" class="img-fluid">
                    <div class="caption">
                    <div class="header-info">
                        <h1><a href="#">Travel and Tour Place Recommendation System</a></h1>
                        <lable></lable>
                        <h3><a href="#">Explore More, Worry Less </a></h3>
                    </div>
                    </div>
                </div>
            </div>
        </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!-- banner -->	
<!-- Slider End -->
<!--About-->
<div class="about section" id="section-2">
    <div class="about-head text-center">
        <h3>About Us</h3>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-12 col-md-12">
            <p align="justify">This Laravel-based PHP project is designed to suggest travel destinations based on user preferences. The system allows users to choose various criteria. Based on this information, the application recommendation match users with destinations that align with their preferences. 

The project will feature a clean and user-friendly interface, where users can easily choose their preferences, and receive a list of destinations that best fit their needs. </p>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!--/About-->
<!-- Contact -->
<div id="section-5" class="contact-section">
<div class="contact-head text-center">

<br>  
<h3></h3>
<br>
<h4 style="color:#000"></h4>
<br>
<br>

<br>  
<h3>Contact Us</h3>
<br>
<h4 style="color:#000">Plan Your Trip</h4>
<br>
<h5 style="color:#000">Our travel experts can help you about tour plan</h5>
<div class="">
    <div class="container">
        <div class="col-md-4 address">
        <h4 style="color:#09F"></h4>
        <p style="color:#000"><br/>
        </p>
        <br/>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{route('submit_contact')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="col-12 col-sm-3 col-form-label"><b>Name:</b></label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" value="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label"><b>Mobile:</b></label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="mobile" value="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label"><b>Email:</b></label>
                            <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" value="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <br>
                            <label class="col-sm-3 col-form-label"><b>Message</b>:</b></label>
                            <div class="col-sm-6">
                            <textarea class="form-control" name="message" rows="3" cols="12" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<br>
@endsection



