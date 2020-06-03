@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.edit_users")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li>
            <a href="{{ route("dashboard.users.index") }}">
                @lang("site.users")
            </a>
        </li>

        <li class="active">@lang("site.edit_breadcrumb")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-body">

            <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method("PUT")

                {{-- The First Name Of Admin. --}}
                <div class="form-group">

                    <label for="first_name">@lang("site.first_name_users") :- </label>
                    <input
                        type="text"
                        name="first_name"
                        id="first_name"
                        class="form-control margin @error('first_name') is-invalid @enderror"
                        placeholder="@lang('site.first_name_placeholder_users')"
                        value="{{ $user->first_name }}"
                        outofocus
                        required
                    />
                    @error('first_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Last Name Of Admin. --}}
                <div class="form-group">

                    <label for="last_name">@lang("site.last_name_users") :- </label>
                    <input
                        type="text"
                        name="last_name"
                        id="last_name"
                        class="form-control margin @error('last_name') is-invalid @enderror"
                        placeholder="@lang('site.last_name_placeholder_users')"
                        value="{{ $user->last_name }}"
                        required
                    />
                    @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Email Of Admin. --}}
                <div class="form-group">

                    <label for="email">@lang("site.email_users") :- </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control margin @error('email') is-invalid @enderror"
                        placeholder="@lang('site.email_placeholder_users')"
                        value="{{ $user->email }}"
                        required
                    />
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>

                {{-- The Image Of Admin. --}}
                <div class="form-group">

                    <label for="image">@lang("site.image_users") :- </label>
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

                    <p>@lang("site.no_image")</p>

                    <div style="width: 100px;height: 100px">
                        <img
                            src="{{ asset('upload_files/users/images/' . $user->image) }}"
                            width="100%"
                            style="height: 100%"
                            class="img-circle img-thumbnail image-preview"
                        />
                    </div>

                </div>

                {{-- Permissions. --}}
                @php
                    $models = ["users", "categories", "authors", "comments", "books"];
                    $flags  = ["create", "read", "update", "delete"];
                @endphp

                <div class="form-group">

                    <div class="tabbable-panel">

                        <div class="tabbable-line">

                            <ul class="nav nav-tabs ">

                                @foreach($models as $index => $model)

                                    <li class="{{ $index == 0 ? 'active' : '' }}">
                                        <a href="#tab_default_{{ $index }}" data-toggle="tab">
                                            @lang("site.$model")
                                        </a>
                                    </li>

                                @endforeach

                            </ul>

                            <div class="tab-content">

                                @foreach($models as $index => $model)

                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="tab_default_{{ $index }}">

                                            @foreach($flags as $index => $flag)

                                                <input
                                                    type="checkbox"
                                                    value="{{ $flag . " " .  $model}}"
                                                    name="permissions[]"
                                                    class="@error('password_confirm') is-invalid @enderror"
                                                    {{ $user->hasPermissionTo($flag . " " .  $model) ==  $flag . " " .  $model ? "checked" : ""}}
                                                />
                                                <label class="flag">@lang("site.$flag")</label>

                                            @endforeach

                                        </div>

                                @endforeach

                            </div>

                        </div>

                    </div>
                    @error('permissions')
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
