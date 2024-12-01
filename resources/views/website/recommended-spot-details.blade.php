@extends('layouts.website.index')
@section('contents')
@php
    $allDivision = App\Models\Division::orderBy('division_id', 'DESC')->get();
    $allTypesOfAttraction = App\Models\TypesOfAttraction::orderBy('types_of_attraction_id', 'DESC')->get();
@endphp
<div class="container recommendation_container">    
    <div class="row">
        <div class="card-body">
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
                    <p align="justify">{{($spot->spot_details)}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <p align="justify"><b class="recommendation_spot_vehicles">Types of Vehicles: </b>{{($spot->spot_ways_to_go)}}</p>
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
            <hr>
    
			<div class="row">
                <div class="col-md-12">
                @php
                    $total_rating_no = $spot->spot_number_of_total_ratings;
                    $comfortable = 0; 
                    $safe = 0;
                    if($total_rating_no!=0){
                        $comfortable = $spot->spot_comfortable_total_rating_point/$total_rating_no; 
                        $safe = $spot->spot_safe_total_rating_point/$total_rating_no;
                    } 
                @endphp
                <br>
                <h2 class="text-center recommendation_spot_title text-primary"><b>Spot Total Reviews: <span class="text-success" id="total_review">{{$spot->spot_number_of_total_ratings}}</span></b></h2>
                <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="spot-review-rating-questions"><h4><b>How comfortable the journey was? <br><span class="btn btn-secondary" id="comfortable_rating"><b>{{number_format($comfortable,1)}} (5)</b></span></b></h4></span>
                        </div>
                        <div class="col-md-5">
                            <span class="spot-review-rating-questions"><h4><b>How safe the place was? <br><span class="btn btn-secondary" id="safe_rating"><b>{{number_format($safe,1)}} (5)</b></span></b></h4></span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12">
                <br>
                <h2 class="text-center recommendation_spot_title text-primary"><b>Spot Review & Ratings</b></h2>
                <br><br>
                    <form method="" id="spot_review_rating" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <span class="spot-review-rating-questions"><h4><b>How comfortable the journey was?<span class="text-danger">*</span></b></h4></span>
                            <input type="hidden" name="id" value="{{$spot->spot_id}}">
                            <div class="stars">
                            <input class="star_first_rating star_first_rating-5" id="star_first_rating-5" type="radio" name="star_first_rating" value="5" required/>
                            <label class="star_first_rating star_first_rating-5" for="star_first_rating-5"></label>
                            <input class="star_first_rating star_first_rating-4" id="star_first_rating-4" type="radio" name="star_first_rating" value="4" required/>
                            <label class="star_first_rating star_first_rating-4" for="star_first_rating-4"></label>
                            <input class="star_first_rating star_first_rating-3" id="star_first_rating-3" type="radio" name="star_first_rating" value="3" required/>
                            <label class="star_first_rating star_first_rating-3" for="star_first_rating-3"></label>
                            <input class="star_first_rating star_first_rating-2" id="star_first_rating-2" type="radio" name="star_first_rating" value="2" required/>
                            <label class="star_first_rating star_first_rating-2" for="star_first_rating-2"></label>
                            <input class="star_first_rating star_first_rating-1" id="star_first_rating-1" type="radio" name="star_first_rating" value="1" required/>
                            <label class="star_first_rating star_first_rating-1" for="star_first_rating-1"></label>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <span class="spot-review-rating-questions"><h4><b>How safe the place was?<span class="text-danger">*</span></b></h4></span>
                            <div class="stars">
                            <input class="star_second_rating star_second_rating-5" id="star_second_rating-5" type="radio" name="star_second_rating" value="5" required/>
                            <label class="star_second_rating star_second_rating-5" for="star_second_rating-5"></label>
                            <input class="star_second_rating star_second_rating-4" id="star_second_rating-4" type="radio" name="star_second_rating" value="4" required/>
                            <label class="star_second_rating star_second_rating-4" for="star_second_rating-4"></label>
                            <input class="star_second_rating star_second_rating-3" id="star_second_rating-3" type="radio" name="star_second_rating" value="3" required/>
                            <label class="star_second_rating star_second_rating-3" for="star_second_rating-3"></label>
                            <input class="star_second_rating star_second_rating-2" id="star_second_rating-2" type="radio" name="star_second_rating" value="2" required/>
                            <label class="star_second_rating star_second_rating-2" for="star_second_rating-2"></label>
                            <input class="star_second_rating star_second_rating-1" id="star_second_rating-1" type="radio" name="star_second_rating" value="1" required/>
                            <label class="star_second_rating star_second_rating-1" for="star_second_rating-1"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Review Spot</button>
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                <br>
                <h2 class="text-center recommendation_spot_title text-danger"><b>Spot Location</b></h2>
                <br><br>
                <center>
                    @php
                    $map=$spot->spot_map;
                    echo $map;
                    @endphp
                </center>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Spot Review & Rating Submit
$('#spot_review_rating').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url:"{{url('recommended-spot/review-and-rating/submit')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                //alert('File has been uploaded successfully');
                console.log(data);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: data.success,
                    toast: '',
                    showConfirmButton: false,
                    timer: '2000',
                });
                document.getElementById('total_review').innerHTML=data.total_review;
                document.getElementById('comfortable_rating').innerHTML=data.comfortable_rating+' (5)';
                document.getElementById('safe_rating').innerHTML=data.safe_rating+' (5)';
            },
            error: function(data){
                console.log(data);
        }
    });
});


</script>
@endsection

