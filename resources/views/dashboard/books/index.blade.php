@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.books")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li class="active">@lang("site.books")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-header">

            <div class="form-group">

                <form
                    action="{{ route('dashboard.books.index') }}"
                    method="get"
                    style="width: 40%;display: inline"
                >

                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="@lang('site.placeholder_search_books')"
                        value="{{ request()->search }}"
                        style="display: inline-block;width: 40%"
                    />

                    <button type="submit" class="btn btn-info" style="margin-right: 20px">

                        <i class="fa fa-search"></i>
                        @lang("site.search")

                    </button>

                </form>

                @if(auth()->user()->hasPermissionTo("create books"))
                    <a href="{{ route('dashboard.books.create') }}" style="margin-right: 10px">

                        <button type="button" class="btn btn-info">

                            <i class="fa fa-plus"></i>
                            @lang("site.add_books")

                        </button>

                    </a>
                @else
                    <button type="button" class="btn btn-info" style="margin-right: 10px">

                        <i class="fa fa-plus"></i>
                        @lang("site.add_books")

                    </button>
                @endif

            </div>
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dataTable">

            <thead>

                <tr>
                    <th class="text-center">#</th>
                    <th>@lang("site.name_books")</th>
                    <th>@lang("site.author_books")</th>
                    <th>@lang("site.category_books")</th>
                    <th>@lang("site.ratings_books")</th>
                    <th>@lang("site.actions")</th>
                </tr>

            </thead>

            <tbody>

                @if($books->count() > 0)

                    @foreach($books as $book)

                        <tr>

                            <td style="width: 55px;line-height: 38px">

                                <div style="width:50px;height:50px">
                                    <img
                                        src="{{ asset('upload_files/books/images/'. $book->image_book) }}"
                                        width="100%"
                                        style="height: 100%"
                                        class="img-thumbnail"
                                    />
                                </div>

                            </td>
                            <td style="line-height: 38px">{{ $book->name }}</td>
                            <td style="line-height: 38px">{{ $book->author->first_name }} &nbsp {{ $book->author->last_name }}</td>
                            <td style="line-height: 38px">{{ $book->category->name }}</td>
                            <td style="padding-top: 15px">

                                <div id="ratingBook" data-rateyo-rating="{{ $book->rating_book }}"></div>
                                <p
                                    style="margin: 0;padding-right: 30px;color: #f39c12"
                                >( {{ $book->rating_book }} من 5 )</p>

                            </td>
                            <td style="line-height: 38px">

                                @if(auth()->user()->hasPermissionTo("update books"))
                                    <a href="{{ route('dashboard.books.edit', $book->id) }}">

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

                                @if(auth()->user()->hasPermissionTo("delete books"))
                                        <form
                                            action="{{ route('dashboard.books.destroy', $book->id) }}"
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

            {{ $books->appends(request()->query())->links() }}

        </div>

    </div>

@endsection
