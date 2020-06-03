@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.comments")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li class="active">@lang("site.comments")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-header">

            <div class="form-group">

                <form
                    action="{{ route('dashboard.comments.index') }}"
                    method="get"
                    style="width: 40%;display: inline"
                >

                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="@lang('site.placeholder_search_comments')"
                        value="{{ request()->search }}"
                        style="display: inline-block;width: 40%"
                    />

                    <button type="submit" class="btn btn-info" style="margin-right: 20px">

                        <i class="fa fa-search"></i>
                        @lang("site.search")

                    </button>

                </form>

                @if(auth()->user()->hasPermissionTo("create comments"))
                    <a href="{{ route('dashboard.comments.create') }}" style="margin-right: 10px">

                        <button type="button" class="btn btn-info">

                            <i class="fa fa-plus"></i>
                            @lang("site.add_comments")

                        </button>

                    </a>
                @else
                    <button type="button" class="btn btn-info" style="margin-right: 10px">

                        <i class="fa fa-plus"></i>
                        @lang("site.add_comments")

                    </button>
                @endif

            </div>
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dataTable">

            <thead>

                <tr>
                    <th class="text-center">#</th>
                    <th>@lang("site.book_comments")</th>
                    <th>@lang("site.user_comments")</th>
                    <th>@lang("site.comment")</th>
                    <th>@lang("site.rating_book")</th>
                    <th>@lang("site.actions")</th>
                </tr>

            </thead>

            <tbody>

                @if($comments->count() > 0)

                    @foreach($comments as $index => $comment)

                        <tr>
                            <td style="line-height: 38px" class="text-center">{{ $index }}</td>
                            <td style="line-height: 38px">{{ $comment->book->name }}</td>
                            <td style="line-height: 38px">{{ $comment->user->first_name . " " . $comment->user->last_name }}</td>
                            <td style="line-height: 38px">{{ $comment->comment }}</td>
                            <td style="padding-top: 15px">

                                <div id="ratingIndex{{ $index }}" data-rateyo-rating="{{ $comment->rating }}"></div>

                            </td>
                            <td style="line-height: 38px">

                                @if(auth()->user()->hasPermissionTo("update comments"))
                                    <a href="{{ route('dashboard.comments.edit', $comment->id) }}">

                                        <button type="button" class="btn btn-primary">

                                            <i class="fa fa-edit"></i>
                                            @lang("site.edit")

                                        </button>

                                    </a>
                                @else
                                    <button type="button" class="btn btn-primary disabled">

                                        <i class="fa fa-edit"></i>
                                        @lang("site.edit")

                                    </button>
                                @endif

                                @if(auth()->user()->hasPermissionTo("delete comments"))
                                    <form
                                        action="{{ route('dashboard.comments.destroy', $comment->id) }}"
                                        method="post"
                                        style="display: inline-block"
                                    >

                                        @csrf
                                        @method("DELETE")

                                        <button type="submit" class="btn btn-danger delete">

                                            <i class="fa fa-trash"></i>
                                            @lang("site.delete")

                                        </button>

                                    </form>
                                @else
                                    <button type="submit" class="btn btn-danger disabled">

                                        <i class="fa fa-trash"></i>
                                        @lang("site.delete")

                                    </button>
                                @endif

                            </td>

                        </tr>

                    @endforeach

                @else

                    <tr class="text-center">
                        <td colspan="6">
                            <h2>@lang("site.no_date")</h2>
                        </td>
                    </tr>

                @endif

            </tbody>

        </table>

            {{ $comments->appends(request()->query())->links() }}

        </div>

    </div>

@endsection
