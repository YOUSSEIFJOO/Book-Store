@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.add_categories")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li>
            <a href="{{ route("dashboard.categories.index") }}">
                @lang("site.categories")
            </a>
        </li>

        <li class="active">@lang("site.create_breadcrumb")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-body">

            <form action="{{ route('dashboard.categories.store', $category->id) }}" method="post">

                @csrf

                {{-- The Name Of Author. --}}
                <div class="form-group">

                    <label for="name">@lang("site.name_categories") :- </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control margin @error('name') is-invalid @enderror"
                        placeholder="@lang('site.name_placeholder_categories')"
                        value="{{ old('name') }}"
                        outofocus
                        required
                    />
                    @error('name')
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
