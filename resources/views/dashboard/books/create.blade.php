@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.add_books")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li>
            <a href="{{ route("dashboard.books.index") }}">
                @lang("site.books")
            </a>
        </li>

        <li class="active">@lang("site.create_breadcrumb")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-body">

            <form action="{{ route('dashboard.books.store') }}" method="post" enctype="multipart/form-data">

                @csrf

                {{-- The Name Of Book. --}}
                <div class="form-group">

                    <label for="name">@lang("site.name_books") :- </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control margin @error('first_name') is-invalid @enderror"
                        placeholder="@lang('site.name_placeholder_books')"
                        value="{{ old('name') }}"
                        outofocus

                    />
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Author Of Book. --}}
                <div class="form-group">

                    <label for="author">@lang("site.author_books") :- </label>
                    <select
                        name="author_id"
                        id="author"
                        class="form-control margin @error('author_id') is-invalid @enderror"

                    >
                        <option disabled selected>@lang("site.select_author_lang")</option>

                        @foreach($authors as $author)

                            <option
                                value="{{ $author->id }}"
                                {{ old("author_id") == $author->id ? "selected" : "" }}
                            >
                                {{ $author->first_name . " " .  $author->last_name }}
                            </option>

                        @endforeach

                    </select>
                    @error('author_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Category Of Book. --}}
                <div class="form-group">

                    <label for="category">@lang("site.category_books") :- </label>
                    <select
                        name="category_id"
                        id="category"
                        class="form-control margin @error('category_id') is-invalid @enderror"

                    >
                        <option disabled selected>@lang("site.select_category_lang")</option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old("category_id") == $category->id ? "selected" : "" }}
                            >
                                {{ $category->name }}
                            </option>

                        @endforeach

                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Image Of Book. --}}
                <div class="form-group">

                    <label for="image_book">@lang("site.image_books") :- </label>
                    <input
                        type="file"
                        name="image_book"
                        id="image_book"
                        class="form-control margin @error('image_book') is-invalid @enderror image"

                    />
                    @error('image_book')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Image Preview --}}
                <div class="form-group">

                    <div style="width: 200px;height: 200px">
                        <img
                            src="{{ asset('upload_files/books/images/default.jpg') }}"
                            width="100%"
                            style="height: 100%"
                            class="img-thumbnail image-preview"

                        />
                    </div>

                </div>

                {{-- The Description Of Book. --}}
                <div class="form-group">

                    <label for="desc">@lang("site.desc_books") @lang("site.less_than_50") :- </label>
                    <textarea
                        name="desc"
                        id="desc"
                        class="form-control margin @error('desc') is-invalid @enderror"
                        style="height: 150px"

                    ></textarea>
                    @error('desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Language Of Book. --}}
                <div class="form-group">

                    <label for="lang">@lang("site.lang_books") :- </label>
                    <select
                        name="lang"
                        id="lang"
                        class="form-control margin @error('lang') is-invalid @enderror"

                    >
                        <option disabled selected>@lang("site.select_book_lang")</option>

                        <option
                            value="@lang("site.arabic_book")"
                            {{ old("lang") ==  __("site.arabic_book") ? "selected" : ""}}
                        >@lang("site.arabic_book")</option>

                        <option
                            value="@lang("site.translate_book")"
                            {{ old("lang") ==  __("site.translate_book") ? "selected" : ""}}
                        >@lang("site.translate_book")</option>

                    </select>
                    @error('lang')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The File Of Book. --}}
                <div class="form-group">

                    <label for="file_book">@lang("site.file_books") :- </label>
                    <input
                        type="file"
                        name="file_book"
                        id="file_book"
                        class="form-control margin @error('file_book') is-invalid @enderror"
                    />
                    @error('file_book')
                    <div class="alert alert-danger">{{ $message }}</div>
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
