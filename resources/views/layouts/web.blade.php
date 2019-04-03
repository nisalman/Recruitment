<!DOCTYPE html>
<html>
@stack('css')
    <script>
        var _token = "{{csrf_token()}}";
        var url = window.location.pathname;
    </script>

    <link rel="shortcut icon" href="/images/logo.png"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome | BJMC</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('toggle/css/bootstrap-toggle.min.css')}}">


    <link rel="stylesheet" href="/dist/css/se.css?v={{uniqid()}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/toggle.css')}}">
    <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


    <!-- SlimScroll -->

    <link rel="stylesheet" href="/css/wiz.css">
    <link rel="stylesheet" href="/css/approved-wiz.css">

    <link href="{{asset('bower_components/jquery-ui/themes/base/jquery-ui.css')}}">


    <!-- jQuery 3 -->
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/jQueryUI/jquery-ui.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('bootstrap-sweetalert-master/dist/sweetalert.css')}}">
    <script src="{{asset('bootstrap-sweetalert-master/dist/sweetalert.js')}}"></script>
    <script src="{{asset('bootstrap-sweetalert-master/dist/sweetalert.min.js')}}"></script>
    <script src="{{asset('http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js')}}"></script>
    <!-- SlimScroll -->

    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>

    <!-- AdminLTE for demo purposes -->

    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css')}}">
    <script src="{{asset('js/plugins/bangla-date/jquery_bangla_date_picker.js')}}"></script>
    <script src="{{asset('js/plugins/bangla-date/local_bn.js')}}"></script>
    <script src="{{asset('js/phonetic/driver.phonetic.js')}}"></script>
    <script src="{{asset('js/phonetic/engine.js')}}"></script>
    <script src="{{asset('toggle/js/bootstrap-toggle.min.js')}}"></script>

    <script src="{{asset('dist/js/demo.js')}}"></script>

    <style type="text/css">
        .image_height {
            max-height: 200px;
            min-width: 100%;
        }
        .skin-black .main-header .navbar .navbar-nav > li > a {
            font-size: 14px !important;
        }
    </style>
    @yield('header')
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-black layout-boxed layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="/" class="navbar-brand"> <i class="fa fa-home"></i> </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/general') }}">Common Questionnaires <span class="sr-only">(current)</span></a>
                        </li>
                        <li><a href="{{ url('/opinion') }}"> Your Opinion <span class="sr-only">(current)</span></a></li>
                        <li><a href="{{ url('/contact') }}"> Contact us <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    </li>
                    </ul>
                    <form action="" class="navbar-form navbar-right original search" method="get">

                        <div class="input-group">
                            <input required="" aria-describedby="basic-addon1" type="number" class="form-control"
                                   name="trackingNumber" placeholder="@lang('Tracking Number')"
                                   id="navbar-search-input"/>
                            <span style="
    background: #fff;
    border: 0;
    padding: 4px;" class="input-group-addon">
                <button class="grp" type="submit">
                  <i class="fa fa-search "></i>
                </button>
               </span>
                        </div>

                    </form>


                    <script>
                        $(function () {
                            $('.search').on('submit', function (e) {
                                e.preventDefault();
                                window.location = '/application-form/' + document.getElementById('navbar-search-input').value;
                            });
                        })
                    </script>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav menu_size">
                        <!-- Messages: style can be found in dropdown.less-->
                        @if(Auth::guest())
                            <li><a href="/login">@lang('auth.login')</a></li>
                            <li><a href="/register">@lang('auth.registration') </a></li>
                        @else
                            @if(Auth::user()->hasRole(['dc', 'nsc','bsc', 'ministry']))
                                <li><a href="/admin">Admin</a></li>

                            @else
                                <li><a href="/application-form">Apply</a></li>
                            @endif

                            <form style="display: none;" action="/logout" method="post"
                                  id="logout">{{csrf_field()}}</form>
                            <li><a href="javascript:"
                                   onclick="document.getElementById('logout').submit()">@lang('auth.logout')</a></li>
                        @endif
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper web">
        <div class="container">
            <!-- Content Header (Page header) -->

            <!-- banner -->
            <section class="banner">
                <div class="row ">

                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <!--      <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                              </ol>
                         -->
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="/images/b1.jpg" alt="" class="img-responsive  image_height">
                            </div>

                            <div class="item">
                                <img src="/images/5th_Bannar_pm_pic_banner.jpg" alt=""
                                     class="img-responsive image_height">
                            </div>

                            <div class="item">
                                <img src="/images/MOYS-bannar.jpg" alt="" class="img-responsive image_height">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <!--   <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span> -->
                        </a>
                    </div>
                </div>
            </section>
            <!-- banner -->

            <section class="content-header text-center">

                <h1 id="title">
                </h1>
                <br>
                <!--         <ol class="breadcrumb">
                          <li><a href="#">Layout</a></li>
                          <li class="active">Top Navigation</li>
                        </ol> -->
            </section>

            <!-- Main content -->
            <section class="content">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{session()->get('error')}}
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-danger">
                        {{session()->get('success')}}
                    </div>
                @endif
                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2019 <a href="#">WorldTech</a>.</strong> All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->
<script src={{url("https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js")}}></script>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error}}');
        </script>
    @endforeach
@endif
<!-- <script src="/js/vue.js"></script> -->
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="/js/se.js?v={{uniqid()}}"></script>
@stack('scripts')
{!! Toastr::message() !!}
</body>
</html>
