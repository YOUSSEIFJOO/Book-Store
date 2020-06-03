@extends('dashboard.layouts.app')

@section("body_content")

    <h1>
        @lang("site.users")
    </h1>

    <ol class="breadcrumb">

        <li>

            <a href="{{ route("dashboard.welcome") }}">
                <i class="fa fa-dashboard"></i>@lang("site.home")
            </a>

        </li>

        <li class="active">@lang("site.users")</li>

    </ol>

    <div class="box box-primary">

        <div class="box-header">

            <div class="form-group">

                <form
                    action="{{ route('dashboard.users.index') }}"
                    method="get"
                    style="width: 40%;display: inline"
                >

                    <input
                        type="search"
                        name="search"
                        class="form-control"
                        placeholder="@lang('site.placeholder_search')"
                        value="{{ request()->search }}"
                        style="display: inline-block;width: 40%"
                    />

                    <button type="submit" class="btn btn-info" style="margin-right: 20px">

                        <i class="fa fa-search"></i>
                        @lang("site.search")

                    </button>

                </form>

                @if(auth()->user()->hasPermissionTo("create users"))
                    <a href="{{ route('dashboard.users.create') }}" style="margin-right: 10px">

                        <button type="button" class="btn btn-info">

                            <i class="fa fa-plus"></i>
                            @lang("site.add_users_index")

                        </button>

                    </a>
                @else
                    <button type="button" class="btn btn-info" style="margin-right: 10px">

                        <i class="fa fa-plus"></i>
                        @lang("site.add_authors_index")

                    </button>
                @endif

            </div>
        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dataTable">

            <thead>

                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang("site.first_name_users")</th>
                    <th class="text-center">@lang("site.last_name_users")</th>
                    <th class="text-center">@lang("site.email_users")</th>
                    <th class="text-center">@lang("site.actions")</th>
                </tr>

            </thead>

            <tbody class="text-center">

                @if($users->count() > 0)

                    @foreach($users as $index => $user)

                        <tr>

                            <td style="width: 55px;line-height: 38px">

                                <div style="width:50px;height:50px">
                                    <img
                                        src="{{ asset('upload_files/users/images/'. $user->image) }}"
                                        width="100%"
                                        style="height: 100%"
                                        class="img-circle img-thumbnail"
                                    />
                                </div>

                            </td>
                            <td style="line-height: 38px">{{ $user->first_name }}</td>
                            <td style="line-height: 38px">{{ $user->last_name }}</td>
                            <td style="line-height: 38px">{{ $user->email }}</td>
                            <td style="line-height: 38px">

                                @if(auth()->user()->hasPermissionTo("update users"))
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}">

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

                                @if(auth()->user()->hasPermissionTo("delete users"))
                                    <form
                                        action="{{ route('dashboard.users.destroy', $user->id) }}"
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

                    <tr>
                        <td colspan="5">
                            <h2>@lang("site.no_date")</h2>
                        </td>
                    </tr>

                @endif

            </tbody>

        </table>

            {{ $users->appends(request()->query())->links() }}

        </div>

    </div>

@endsection
