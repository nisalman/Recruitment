<!DOCTYPE html>
<html>
<head>
    <script>
        var _token = "{{csrf_token()}}";
        var url = window.location.pathname;
        var host = window.location.host;
        var submit = "@lang('Submit')";
        var yes = "@lang('Yes')";
        var no = "@lang('No')";
        var confirmMsg = "@lang('Are you sure?')";
        var cancel = "@lang('Cancel')";
        var forwardTitle = "@lang('Forward To')";
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin| Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
    {{--<link rel="stylesheet" href="{{asset('datatables.net-bs/css/dataTables.bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.rateyo.min.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--script src="/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script--!>
    <![endif]-->
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"--!>

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css"-->
    <!-- Latest compiled and minified JavaScript -->
    <!-- Google Font -->
    <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"-->

    <link rel="stylesheet" href="/dist/css/se.css?v={{uniqid()}}">
    <link rel="stylesheet" href="/css/admin.css?v={{uniqid()}}">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.min.css">
    <!-- jQuery 3 -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>

    <!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <!--script src="/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <!--script src="/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <!--script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <!--script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll -->
    <!--script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS -->
    <script src="/bower_components/chartjs/Chart.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}

    <script src="/bower_components/datatables.net/js/jquery.dataTables.js"></script>
    <script src="/js/plugins/sweetalert2.min.js"></script>
    <script src="/js/plugins/jquery.rateyo.min.js"></script>

    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <!-- bangla -->
    <script src="/js/plugins/bangla-date/jquery_bangla_date_picker.js"></script>
    <script src="/js/plugins/bangla-date/local_bn.js"></script>
    <script src="/js/phonetic/driver.phonetic.js"></script>
    <script src="/js/phonetic/engine.js"></script>
    <!-- bangla -->

    <link rel="stylesheet" href="/css/wiz.css">
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 60%;
        }

        #sortable li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            height: 1.5em;
        }

        html > body #sortable li {
            height: 1.5em;
            line-height: 1.2em;
        }

        .ui-state-highlight {
            height: 1.5em;
            line-height: 1.2em;
        }

        .zoom {

            transition: transform .2s;

            height: 20%;

        }

        .zoom:hover {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Safari 3-8 */
            transform: scale(2.5);
        }

        table {
            width: 100%;
        }

        table, th, td {
            border: 1px solid #eee;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        table#t01 tr:nth-child(even) {
            background-color: #b0c5de;
        }

        table#t01 tr:nth-child(odd) {
            background-color: #f39c1230;
        }

        table#t01 th {
            background-color: #005B96;
            color: white;
        }

    </style>
    <style type="text/css">
        @media print {
            .status {
                display: none !important;
            }

            .pending-status {
                display: none !important;
            }

            .hidden {
                display: block !important;
            }

            .priority {
                display: none !important;
            }


        }
    </style>

</head>
<body class="sidebar-mini skin-blue-light">
<div id="loading" style="display: none;">
    <img width="100px" src="/images/loading.gif" alt="">
</div>
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- <span class="logo-mini"><b>A</b>LT</span> -->
            <span class="fa fa-dashboard logo-mini"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">@lang('default.dashboard')</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{$user->avatar}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{$user->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{$user->avatar}}" class="img-circle">

                                <p>
                                    {{$user->name}} {{$user->designation?'-'.$user->designation->name:''}}
                                </p>
                            </li>
                            <!-- Menu Body -->


                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <form method="post" action="/logout" id="logout"
                                          class="hidden">{{csrf_field()}}</form>
                                    <a href="javascript:" onclick="document.getElementById('logout').submit()"
                                       class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>

        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{$user->avatar}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{$user->name}}</p>
                </div>
            </div>


            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Main Menu</li>
                <!-- se menu -->
                <li>
                    <a href="/admin">
                        <i class="fa fa-dashboard"></i> <span>@lang('default.dashboard')</span>
                    </a>
                </li>
                @role(['special'])
                <li>
                    <a href="/admin/form-submissions">
                        <i class="fa fa-wpforms"></i> <span>অ্যাপ্লিকেশন</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/form-app/check">
                        <i class="fa fa-wpforms"></i> <span>অ্যাপ্লিকেশন চেক</span>
                    </a>
                </li>
                @endrole

                @if(Auth::user()->hasRole(['dc','ministry','bsc','nsc']))
                    @role(['bsc'])
                    <li>
                        <a href="/available-jobs">
                            <i class="fa fa-wpforms"></i> <span>Urgent Application</span>
                        </a>
                    </li>
                    @endrole
                    <li>
                        <a href="/admin/application-pending">
                            <i class="fa fa-wpforms"></i> <span>@lang('application.application_pending')</span>
                        </a>
                    </li>

                    <li>
                        <a href="/admin/application-list">
                            <i class="fa fa-wpforms"></i> <span>@lang('application.application_list')</span>
                        </a>
                    </li>
                    @role(['ministry','bsc'])

                    <li>
                        <a href="/admin/get-total-application">
                            <i class="fa fa-wpforms"></i> <span>
                                All Application List</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/users">
                            <i class="fa fa-user"></i> <span>User</span>
                        </a>
                    </li>
                    <!-- se menu -->

                    <li class="treeview">
                        <a href="#">
                            <!-- <i class="fa fa-gear"></i> -->
                            <span>Setting</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/setup/jobs"></i> Job Setup </a></li>
                            <li><a href="/admin/setup/center"></i> Center Setup </a></li>
                            <li><a href="/admin/setup/room"></i> Room Setup </a></li>
                            <li><a href="/admin/setup/sit-plan"></i> Sit Plan Setup </a></li>
                            <li><a href="/admin/setup/Form-Setup"></i> Form Setup </a></li>
                            <li><a href="/admin/setup/images"></i> Image Setup </a></li>
                            <li><a href="/admin/setup/player-type"></i> Owner Organization Position </a></li>
                             <li><a href="/admin/setup/sports"></i> খেলার তালিকা </a></li>
                             <li><a href="/admin/setup/federations"></i> ফেডারেশন </a></li>
                             <li><a href="/admin/setup/associations"></i> অ্যাসোসিয়েশান</a></li>

                             <li><a href="/admin/setup/organizations"></i> সংস্থা </a></li>
                             <li><a href="/admin/setup/designations"></i> পদবি </a></li>

                             <li><a href="/admin/setup/player-lebel"></i> পর্যায় </a></li>
                             <li><a href="/admin/setup/pre_exam"></i> Pre Exam </a></li>
                             <li><a href="/admin/setup/marks-entry"></i> Marks Entry </a></li>
                             <li><a href="/admin/setup/upazila"></i> উপজেলা </a></li>
                              <li><a href="/admin/setup/year"></i> ইয়ার </a></li>
                        </ul>
                    </li>
                    @endrole
                    <li class="treeview">
                        <a href="#">
                            <!-- <i class="fa fa-gear"></i> -->
                            <span>Report</span>
                            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            @role(['ministry','bsc'])
                            <li><a href="/admin/report/application-report"></i> Applicant Report</a></li>
                            <li><a href="/admin/report/application-user-new-report"></i>Applicant All list</a></li>
                            <li><a href="/admin/report/application-user-pending-report"></i> Pending Application </a>
                            <li><a href="/admin/report/sit"></i>Sit </a>
                            </li>
                            {{--<li><a href="/admin/report/application-user-list-report"></i>Pending Full list</a></li>--}}
                            @endrole

                            @role(['dc'])
                            <li><a href="/admin/report/application-report"></i>Applicant Report</a></li>
                            <li><a href="/admin/report/application-user-pending-report"></i>Pending Application </a>

                            </li>
                            {{--<li><a href="/admin/report/application-user-list-report"></i>Pending Full list</a></li>--}}
                            @endrole
                        </ul>
                    </li>
                @else
                @endif


            </ul>


        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--
                  <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                  </ol>
                   -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- content -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                </div>

            @endif

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session()->get('success')}}
                </div>
        @endif

        @yield('content')
        <!-- content -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2018 <a href="#">WorldTech</a>.</strong> All rights
        reserved.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

@if(!$user->mobile)
    <script>
        swal({
            title: '@lang("Please enter your mobile number")',
            input: 'text',
            showCancelButton: false,
            confirmButtonText: '@lang('Submit')',
            showLoaderOnConfirm: true,
            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (email === '') {
                            reject('@lang('Please enter a valid mobile')')
                        } else {
                            $.get('/admin/set-mobile/' + email, function () {
                                resolve()
                            }).fail(function () {
                                reject('@lang('Phone number already in use')')
                            });
                        }
                    }, 100)
                })
            },
            allowOutsideClick: false
        }).then(function (email) {
            swal({
                type: 'success',
                title: '@lang('Thank you')!',
                html: '@lang('Submitted mobile'): ' + email
            })
        })
    </script>
@endif
<script src="/js/se.js?v={{uniqid()}}"></script>
<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>

</body>
</html>
