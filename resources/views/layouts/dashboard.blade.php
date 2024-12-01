<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title> Travel and Tour Place Recommendation System </title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- add icon link -->
        <link rel = "icon" href ="{{asset('contents/admin/assets')}}//img/icon_logo.png" type = "image/x-icon">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/all.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/style.css">
        <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/jquery.dataTables.min.css">
        <script src="{{asset('contents/admin/assets')}}/js/jquery-3.4.1.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/jquery.dataTables.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <header>
            <div class="container-fluid header_container">
                <div class="row p-3 mb-3 header_row">
                    
                </div>
            </div>
        </header>
        <section class="content-section">
            <div class="container-fluid">
                <!-- dashboard -->
                <div class="row">  
                    <!-- start sidebar menu -->
                    <div class="col-lg-3 col-md-12 p-3 mb-2 text-white side_bars"> 

                            <p class="dsb_text text-center"></p>

                            @php
                                $role_id = Auth::user()->role_id;
                                $userDetails = App\Models\User::where('role_id',$role_id)->first();
                                $photo = Auth::user()->photo;
                            @endphp

                            @if($photo!='')
                                <img src="{{asset('uploads/user/'.$photo)}}" alt="User photo" class="rounded-circle img-fluid mx-auto d-block profile-img img-thumbnail" height="85px" width="85px">
                            @else
                                <img src="{{asset('contents/admin/assets')}}/img/avatar.png" alt="User photo" class="rounded-circle img-fluid mx-auto d-block profile-img img-thumbnail" height="85px" width="85px">
                            @endif
                            
                            <h5 class="text-center dsb_sidebar_info">{{ Auth::user()->name; }}</h5>

                            <h6 class="text-center dsb_sidebar_info">{{ $userDetails->roleInfo->role_name }}</h6>

                            <nav class="navbar navbar-expand-lg navbar-light"> <!-- responsive break point -->

                                <!-- icon & target for collapse -->

                                <div class="col-xl-12">
                                    
                                    <button type="button" class="navbar-toggler bg-light" data-toggle="collapse"
                                            data-target="#menus" > <!-- target id collapse -->
                                            <span class="navbar-toggler-icon"></span>
                                    </button>
                                    @php
                                        $role_id=Auth::user()->role_id;
                                    @endphp
                                    <div class="row menu">
                                        <!-- div for collapse with target id -->
                                        <div id="menus" class="collapse navbar-collapse sidevars">
                                            <ul>
                                                <li><a href="{{route('view_user_profile', ['slug' => Auth::user()->user_slug])}}"><i class="fas fa-user-circle"></i> My Profile </a></li>
                                                @if($role_id=='1')
                                                <!-- start dropdown menu -->
                                                <li><a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-city"></i> Division </a>
                                                    <ul class="collapse list-unstyled" id="homeSubmenu1">
                                                        <li><a href="{{ route('all_division') }}"> <i class="fas fa-city"></i> All Division </a></li>
                                                        <li><a href="{{ route('add_division') }}"> <i class="far fa-edit"></i> Add New Division </a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-home"></i> District </a>
                                                    <ul class="collapse list-unstyled" id="homeSubmenu2">
                                                        <li><a href="{{ route('all_district') }}"> <i class="fas fa-home"></i> All District </a></li>
                                                        <li><a href="{{ route('add_district') }}"> <i class="far fa-edit"></i> Add New District </a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-umbrella-beach"></i> Types of Attraction </a>
                                                    <ul class="collapse list-unstyled" id="homeSubmenu3">
                                                        <li><a href="{{ route('all_types_of_attraction') }}"> <i class="fas fa-umbrella-beach"></i> All Types of Attraction </a></li>
                                                        <li><a href="{{ route('add_types_of_attraction') }}"> <i class="far fa-edit"></i> Add New Types of Attraction </a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#homeSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-archway"></i> Spot </a>
                                                    <ul class="collapse list-unstyled" id="homeSubmenu4">
                                                        <li><a href="{{ route('all_spot') }}"> <i class="fas fa-globe-asia"></i> All Spot </a></li>
                                                        <li><a href="{{ route('add_spot') }}"> <i class="far fa-edit"></i> Add New Spot </a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{route('all_contact')}}"><i class="fas fa-envelope"></i> Contact Messages </a></li>
                                                @endif
                                                <li><a href="{{route('edit_user_profile', ['slug' => Auth::user()->user_slug])}}"><i class="fas fa-user-edit"></i> Update Your Profile </a></li>
                                                <li><a href="{{route('change_password', ['slug' => Auth::user()->user_slug])}}"><i class="fas fa-user-edit"></i> Change Password </a></li>
                                                <li><a href="{{url('/')}}"><i class="fas fa-globe-asia"></i> Website </a></li>
                                                <!-- end dropdown menu -->
                                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menul"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
                                                <!-- Authentication -->
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <!-- div end collapse -->
                        </nav>
                    </div>
                    <!-- end sidebar menu -->
                    <!-- start dashboard information/content section -->
                    <div class="col-lg-9 col-md-12 p-3 mb-2 bg-light text-dark" id="dashboard_section"> 
                        <div class="scrollable">
                        <!--data/content -->
                        @yield('dashboard_content')
                        </div>
                    </div>
                    <!-- end dashboard information/content section -->
                </div>
            </div>
        </section>
        <footer class="footer-section">
            <div class="container-fluid">
            </div>
        </footer>        
        <!-- all js link -->
        <script src="{{asset('contents/admin/assets')}}/js/bootstrap.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/all.min.js"></script>
        <script src="{{asset('contents/admin/assets')}}/js/custom.js"></script>
    </body>
</html>