@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.add_comments")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li>
            <a href="{{ route("dashboard.comments.index") }}">
                @lang("site.comments")
            </a>
        </li>

        <li class="active">@lang("site.create_breadcrumb")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-body">

            <form action="{{ route('dashboard.comments.store') }}" method="post">

                @csrf

                {{-- The Name Of User. --}}
                <input type="hidden" name="user_id" value="{{ $user }}" />

                {{-- The Name Of Book. --}}
                <div class="form-group">

                    <label for="book">@lang("site.book_comments") :- </label>
                    <select
                        name="book_id"
                        id="book"
                        class="form-control margin @error('book_id') is-invalid @enderror"

                    >
                        <option disabled selected>@lang("site.select_book_comment")</option>

                        @foreach($books as $book)

                            <option
                                value="{{ $book->id }}"
                                {{ old("book_id") == $book->id ? "selected" : "" }}
                            >
                                {{ $book->name }}
                            </option>

                        @endforeach

                    </select>
                    @error('book_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Name Of Comment. --}}
                <div class="form-group">

                    <label for="comment">@lang("site.comment") :- </label>
                    <textarea
                        name="comment"
                        id="comment"
                        class="form-control margin @error('comment') is-invalid @enderror"
                        rows="5"
                        outofocus

                    >
                        {{ old('comment') }}
                    </textarea>
                    @error('comment')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Rating Of Comment. --}}
                <div class="form-group">

                    <label for="name">@lang("site.rating_book") :- </label>

                    <input type="hidden" id="rateYo" name="rating" class="rating" />
                    <div id="rateYo"></div>

                    @error('rating')
                    <div class="alert alert-danger" style="margin-top: 10px">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Submit The Date. --}}
                <div class="form-group">

                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-plus"></i>
                        @lang("site.add")

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
