<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta charset="UTF-8">

        <title>@lang("site.title_dashboard")</title>


        <!-- Plugins -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/blue.css') }}" />
        @if(app()->getLocale() == "en")
            <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}" />
            <!-- Style Sheet For Me -->
            <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/style.css') }}" />
        @else
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminRTL.min.css') }}">
            <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
            <!-- Style Sheet For Me -->
            <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/style.css') }}" />
            <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/rtl.css') }}">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" />
        @endif
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/_all-skins.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/datepicker3.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/daterangepicker-bs3.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/noty.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/nest.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_files/css/jquery.rateyo.min.css') }}" />

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>

            .margin_no_button {
                margin-right: 5px
            }

        </style>

    </head>

    <body class="skin-blue sidebar-mini">

        <!--Start Content Of The Body Html -->
        <div class="wrapper">

            <!-- Start Main Header -->
            <header class="main-header">

                <a href="{{ route("dashboard.welcome") }}" class="logo">
                    <span class="logo-mini"><b>B</b>ST</span>
                    <span class="logo-lg"><b>Book</b>Store</span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">

                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">

                        <ul class="nav navbar-nav">

                            <li class="dropdown tasks-menu">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    @lang("site.language_dashboard")<i class="fa fa-flag-o"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-language">

                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                        <li class="header">
                                            <a class="language-link" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>

                                    @endforeach

                                </ul>

                            </li>

                            <li class="dropdown user user-menu">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset('upload_files/users/images/'. auth()->user()->image) }}" class="user-image" alt="User Image" />
                                    <span class="hidden-xs">{{ auth()->user()->first_name . " " . auth()->user()->last_name }}</span>
                                </a>

                                <ul class="dropdown-menu">

                                    <li class="user-header">

                                        <div style="width: 70px; height: 70px;margin-right: 95px">
                                            <img
                                                src="{{ asset('upload_files/users/images/'. auth()->user()->image) }}"
                                                class="img-circle img-thumbnail"
                                                alt="User Image"
                                                width="100%"
                                                style="height: 100%"
                                            />
                                        </div>
                                        <p>{{ auth()->user()->first_name . " " . auth()->user()->last_name }}</p>

                                    </li>

                                    <li class="user-footer">

                                        <div class="sign-out">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button class="btn btn-default btn-flat sign-out-btn">@lang("site.sign_out")</button>
                                            </form>
                                        </div>

                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </div>

                </nav>

            </header>
            <!-- End Main Header -->

            <!-- Start Aside -->
            @include("dashboard.layouts._aside")
            <!-- End Aside -->

            <!-- Start The Content Of The Body Page -->
            <div class="content-wrapper">

                <section class="content-header">

                    @yield("body_content")

                </section>

                <section class="content">

                </section>

            </div>
            <!-- End The Content Of The Body Page -->

            <!-- Start Footer -->
            <footer class="main-footer">

                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2020-2021 <a href="http://almsaeedstudio.com">Yousseif Nady</a>.</strong> All rights reserved.

            </footer>
            <!-- End Footer -->

        </div>
        <!-- End Content Of The Body Html -->

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('dashboard_files/js/jQuery-2.1.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/jquery.sparkline.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/jquery.knob.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/daterangepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/bootstrap-datepicker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/jquery.slimscroll.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/fastclick.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
        @if(LaravelLocalization::getCurrentLocale() == "en")
            <script type="text/javascript" src="{{ asset('dashboard_files/js/app.min.js') }}"></script>
        @else
            <script type="text/javascript" src="{{ asset('dashboard_files/js/app.min-RTL.js') }}"></script>
        @endif
        <script type="text/javascript" src="{{ asset('dashboard_files/js/noty.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/jquery.rateyo.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashboard_files/js/custom.js') }}"></script>

        <script>

            $(document).ready(function () {

                {{-- Noty For Create Or Edit --}}
                @if(session()->has("success"))

                    new Noty({
                        type    : 'information',
                        theme   : 'nest',
                        text    : "{{ session('success') }}",
                        timeout : 2000,
                        killer  : true

                    }).show();

                @endif

                {{-- Noty For Delete --}}
                $('.delete').click(function (e) {

                    var that = $(this)
                    e.preventDefault();

                    var n = new Noty({
                                type    : 'warning',
                                theme   : 'nest',
                                text    : "@lang('site.success_delete_confirm')",
                                timeout : 20000,
                                buttons : [

                                    Noty.button("@lang('site.yes')", 'btn btn-success', function () {
                                        that.closest('form').submit();
                                    }),

                                    Noty.button("@lang('site.no')", 'btn btn-primary margin_no_button', function () {
                                        n.close();
                                    })

                                ]

                            }).show();

                });

                {{-- For Preview Image In Create User. --}}
                $(".image").change(function () {

                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('.image-preview').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);
                    }

                });

                {{-- For File Book In Create User. --}}
                $(".book").change(function () {

                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('.book-preview').append(e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);
                    }

                });

                // Ckeditor :-

                // Render Ckeditor.
                CKEDITOR.replace( 'about_him' );
                CKEDITOR.replace( 'desc' );

                // Directory.
                CKEDITOR.config.language =  "{{ app()->getLocale() }}";

                // Rating :-

                // Rendiring Rating
                $("div#rateYo").rateYo({
                    rtl: true,
                    fullStar: true,
                    spacing: "5px"
                });

                // Take The Value From Rating And Give It To Previous Element Input To Store It In Database
                $("div#rateYo").click(function () {

                    var rating =$("div#rateYo").rateYo("rating");
                    $(this).prev("input.rating").attr("value", rating);

                });

                // Rating In Index Page Of Comment.
                @foreach(\App\Comment::all() as $index => $comment)
                    $("#ratingIndex{{ $index }}").rateYo({
                        readOnly: true,
                        rtl: true,
                        starWidth: "20px"
                    });
                @endforeach

                // Rating In Index Page For Book Of Bookss.
                $("#ratingBook").rateYo({
                    readOnly: true,
                    rtl: true,
                    starWidth: "20px"
                });

            });

        </script>

    </body>

</html>
