<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> Travel and Tour Place Recommendation System </title>
        <!-- add icon link -->
        <!-- css -->
        <link rel = "icon" href ="{{asset('contents/website/assets')}}/img/icon_logo.png" type = "image/x-icon">
        <link rel="stylesheet" href="{{asset('contents/website/assets')}}/css/all.min.css">
        <link rel="stylesheet" href="{{asset('contents/website/assets')}}/css/all.css">
        <link rel="stylesheet" href="{{asset('contents/website/assets')}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('contents/website/assets')}}/css/style.css">
        <!--js--> 
        <script src="{{asset('contents/website/assets')}}/js/jquery-3.4.1.min.js"></script>
        <script src="{{asset('contents/website/assets')}}/js/sweetalert2.all.min.js"></script> 
        <script src="{{asset('contents/website/assets')}}/js/custom.js"></script> 
    </head>
    <body>
        <!--header-->
        <!--sticky-->
        <!-- Menu Start -->
        <div class="">
            <!--container-->
            <div class="container">
                <div class="top-nav">
                    <nav class="navbar fixed-top navbar-expand-md navbar-primary header-top">

                    <!-- icon & target for collapse -->

                    <button type="button" class="navbar-toggler button_custom" data-toggle="collapse" data-target="#menus" > <!-- target id collapse -->
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="menus">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a href="{{url('/')}}" class="nav-link"> Home</a></li>
                            <li class="nav-item"><a href="{{url('/')}}#section-2" class="nav-link"> About</a></li>
                            <li class="nav-item"><a href="{{url('recommendation/search')}}" class="nav-link">Spot</a></li>
                            <li class="nav-item"><a href="{{url('/')}}#section-5" class="nav-link"> Contact</a></li>
                            <li class="nav-item"><a class="btn btn-primary btn-lg txt" href="{{ route('login') }}" class="nav-link">Sign in</a></li>
                            <li class="nav-item"><a class="btn btn-success btn-lg txt" href="{{ route('register') }}" class="nav-link">Sign up</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                    </nav>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!--/container-->
        </div>
        <!-- Menu End -->
        <!--/sticky-->
        @yield('contents')
        <!-- Footer Start -->
        <div class="fotter">
            <div class="container">
                <div class="fotter-grids">
                <div class="col-md-4 fotter-left">
                    <p style="text-align:justify"></p>
                </div>
                <div class="col-md-4 fotter-middle">
                    <h3></h3>
                    <div class="footer-list">
                        <h3></h3>
                        <div class="footer-list">
                        </div>
                    </div>
                    <div class="col-md-4 fotter-right" style="padding-left:10px">
                        <h3></h3>
                        <br/>
                        <div class="footer-list">
                        </div>
                    </div>
                    <div class="social-icons">
                        <a href="#"><span class="facebook"> </span></a>
                        <a href="#"><span class="twitter"> </span></a>
                        <a href="#"><span class="googleplus"> </span></a>
                        <a href="#"><span class="pinterest"> </span></a>
                        <a href="#"><span class="instagram"> </span></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="copyright text-right">
            <p style="padding-right:100px"></p>
        </div>
        <!-- Footer End -->
        <!-- js -->
        <script src="{{asset('contents/website/assets')}}/js/bootstrap.min.js"></script>
        <script src="{{asset('contents/website/assets')}}/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
