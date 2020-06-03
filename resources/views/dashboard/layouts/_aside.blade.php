<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">

            <div class="pull-left image" style="width: 50px;height: 50px">
                <img
                    src="{{ asset('upload_files/users/images/'. auth()->user()->image) }}"
                    class="img-circle img-thumbnail"
                    alt="User Image"
                    style="width: 100%; height: 100%"
                />
            </div>

            <div class="pull-left info">
                <p>{{ auth()->user()->first_name . " " . auth()->user()->last_name }}</p>
            </div>

        </div>

        <ul class="sidebar-menu">

            {{-- Books --}}
            <li>
                <a href="{{ route("dashboard.books.index") }}">
                    <i class="fa fa-book"></i>
                    <span>@lang("site.books")</span>
                </a>
            </li>

            {{-- Comments --}}
            <li>
                <a href="{{ route("dashboard.comments.index") }}">
                    <i class="fa fa-comments"></i>
                    <span>@lang("site.comments")</span>
                </a>
            </li>

            {{-- Authors --}}
            <li>
                <a href="{{ route("dashboard.authors.index") }}">
                    <i class="fa fa-users"></i>
                    <span>@lang("site.authors")</span>
                </a>
            </li>

            {{-- Categories --}}
            <li>
                <a href="{{ route("dashboard.categories.index") }}">
                    <i class="fa fa-list-alt"></i>
                    <span>@lang("site.categories")</span>
                </a>
            </li>

            {{-- Users --}}
            <li>
                <a href="{{ route("dashboard.users.index") }}">
                    <i class="fa fa-cog fa-lg"></i>
                    <span>@lang("site.users")</span>
                </a>
            </li>

        </ul>

    </section>

</aside>
