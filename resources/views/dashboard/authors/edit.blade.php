@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.add_authors_create")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li>
            <a href="{{ route("dashboard.authors.index") }}">
                @lang("site.authors")
            </a>
        </li>

        <li class="active">@lang("site.create_breadcrumb")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-body">

            <form action="{{ route('dashboard.authors.update', $author->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method("PUT")

                {{-- The First Name Of Author. --}}
                <div class="form-group">

                    <label for="first_name">@lang("site.first_name_authors") :- </label>
                    <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        class="form-control margin @error('first_name') is-invalid @enderror"
                        placeholder="@lang('site.first_name_placeholder_authors')"
                        value="{{ $author->first_name }}"
                        outofocus
                        required
                    />
                    @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Last Name Of Author. --}}
                <div class="form-group">

                    <label for="last_name">@lang("site.last_name_authors") :- </label>
                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        class="form-control margin @error('last_name') is-invalid @enderror"
                        placeholder="@lang('site.last_name_placeholder_authors')"
                        value="{{ $author->last_name }}"
                        required

                    />
                    @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Image Of Author. --}}
                <div class="form-group">

                    <label for="image">@lang("site.image_authors_create") :- </label>
                    <input
                        type="file"
                        name="image"
                        id="image"
                        class="form-control margin @error('image') is-invalid @enderror image"
                    />
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- Image Preview --}}
                <div class="form-group">

                    <div style="width: 100px;height: 100px">
                        <img
                            src="{{ asset('upload_files/authors/images/' . $author->image) }}"
                            width="100%"
                            style="height: 100%"
                            class="img-circle img-thumbnail image-preview"
                        />
                    </div>

                </div>


                {{-- The About Him Of Author. --}}
                <div class="form-group">

                    <label for="about_him">@lang("site.about_him_authors") @lang("site.less_than_50") :- </label>
                    <textarea
                        name="about_him"
                        id="about_him"
                        class="form-control margin @error('about_him') is-invalid @enderror image"
                        required
                    >
                        {{ $author->about_him }}
                    </textarea>
                    @error('about_him')
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
