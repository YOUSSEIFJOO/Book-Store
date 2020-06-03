@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.dashboard")
    </h1>

    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i>@lang("site.dashboard_breadcrumb")</li>
    </ol>

    <div class="box box-primary">

        <div class="box-body">

            <div class="row">

                {{-- Books. --}}
                <div class="col-lg-3 col-md-3 col-xs-6">

                    <div
                        class="small-box bg-aqua"
                        style="-webkit-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                -moz-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);"
                    >

                        <div class="inner">

                            <h3>{{ \App\Book::count() }}</h3>
                            <p>@lang("site.books")</p>

                        </div>

                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>

                        <a href="{{ route('dashboard.books.index') }}" class="small-box-footer">
                            @lang("site.know_more")
                            <i class="fa fa-arrow-circle-left" style="margin-right: 3px"></i>
                        </a>

                    </div>

                </div>

                {{-- Comments. --}}
                <div class="col-lg-2 col-md-3 col-xs-6">

                    <div
                        class="small-box bg-green"
                        style="-webkit-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                -moz-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);"
                    >

                        <div class="inner">

                            <h3>{{ \App\Comment::count() }}</h3>
                            <p>@lang("site.comments")</p>

                        </div>

                        <div class="icon" style="margin-top: -30px">
                            <i class="fa fa-comments" style="font-size: 50px !important"></i>
                        </div>

                        <a href="{{ route('dashboard.comments.index') }}" class="small-box-footer">
                            @lang("site.know_more")
                            <i class="fa fa-arrow-circle-left" style="margin-right: 3px"></i>
                        </a>

                    </div>

                </div>

                {{-- Authors. --}}
                <div class="col-lg-2 col-md-3 col-xs-6">

                    <div class="small-box bg-yellow"
                         style="-webkit-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                -moz-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);"
                    >

                        <div class="inner">

                            <h3>{{ \App\Author::count() }}</h3>
                            <p>@lang("site.authors")</p>

                        </div>

                        <div class="icon" style="margin-top: -30px">
                            <i class="fa fa-users" style="font-size: 50px !important"></i>
                        </div>

                        <a href="{{ route('dashboard.authors.index') }}" class="small-box-footer">
                            @lang("site.know_more")
                            <i class="fa fa-arrow-circle-left" style="margin-right: 3px"></i>
                        </a>

                    </div>

                </div>

                {{-- Categories Of Books. --}}
                <div class="col-lg-2 col-md-3 col-xs-6">

                    <div class="small-box bg-red"
                         style="-webkit-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                -moz-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);"
                    >

                        <div class="inner">

                            <h3>{{ \App\Category::count() }}</h3>
                            <p>@lang("site.categories")</p>

                        </div>

                        <div class="icon" style="margin-top: -30px">
                            <i class="fa fa-list-alt" style="font-size: 50px !important"></i>
                        </div>

                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">
                            @lang("site.know_more")
                            <i class="fa fa-arrow-circle-left" style="margin-right: 3px"></i>
                        </a>

                    </div>

                </div>

                {{-- Users. --}}
                <div class="col-lg-3 col-md-3 col-xs-6">

                    <div
                        class="small-box bg-teal"
                         style="-webkit-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                -moz-box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);
                                box-shadow: 0px 0px 15px 1px rgba(0, 0, 0, 0.59);"
                    >

                        <div class="inner">

                            <h3>{{ \App\User::count() }}</h3>
                            <p>@lang("site.users")</p>

                        </div>

                        <div class="icon">
                            <i class="fa fa-cog"></i>
                        </div>

                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">
                            @lang("site.know_more")
                            <i class="fa fa-arrow-circle-left" style="margin-right: 3px"></i>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
