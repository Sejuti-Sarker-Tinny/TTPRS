<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Tourist Place Recommendation in Bangladesh </title>
    <!-- add icon link -->
    <link rel = "icon" href ="{{asset('contents/admin/assets')}}/img/icon_logo.png" type = "image/x-icon">
    <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/all.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('contents/admin/assets')}}/css/style.css">
    <script src="{{asset('contents/admin/assets')}}/js/jquery-3.4.1.min.js"></script>   
</head>
<body class="index_body_class">
    <header>
        <div class="container-fluid header_container">
            <div class="row p-3 mb-3 index_header_row">
                <div class="col-12 col-md-9">
                    <h1 class="text-center index_header_text"> Tourist Place Recommendation in Bangladesh </h1>
                </div>
                <div class="col-12 col-md-3">
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Sign in</a>
                    <a class="btn btn-success btn-lg" href="{{ route('register') }}">Sign up</a>
                </div>
            </div>
        </div>
    </header>
    <section>       
    </section>
</body>
</html>