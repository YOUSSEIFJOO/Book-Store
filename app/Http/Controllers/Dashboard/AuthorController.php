<?php

namespace App\Http\Controllers\Dashboard;

use App\Author;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin','permission:create authors'])->only("create");
        $this->middleware(['role:super-admin|admin','permission:read authors'])->only("index");
        $this->middleware(['role:super-admin|admin','permission:update authors'])->only("edit");
        $this->middleware(['role:super-admin|admin','permission:delete authors'])->only("destroy");
    }

    public function index(Request $request)
    {
        $authors = Author::when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

                })->latest()->paginate(5);

        return view("dashboard.authors.index", compact("authors"));
    }

    public function create(Author $author)
    {
        return view("dashboard.authors.create", compact("author"));
    }

    public function store(Request $request)
    {
        $request->validate([

            "first_name"    => "required | string",
            "last_name"     => "required | string",
            "image"         => "required | image",
            "about_him"     => "required | min:5",

        ]);

        $request_data = $request->except("image");

        if($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("upload_files/authors/images/" . $request->image->hashName()));

            $request_data["image"] = $request->image->hashName();
        }

        Author::create($request_data);

        session()->flash("success", __("site.success_create"));
        return redirect(route("dashboard.authors.index"));
    }

    public function edit(Author $author)
    {
        return view("dashboard.authors.edit", compact("author"));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([

            "first_name"    => "required | string",
            "last_name"     => "required | string",
            "image"         => "image",
            "about_him"     => "required | min:5",

        ]);

        $request_data = $request->except("image");

        if($request->image !== null) {

            Storage::disk("public_uploads")->delete("authors/images/$author->image");

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("upload_files/authors/images/" . $request->image->hashName()));

            $request_data["image"] = $request->image->hashName();
        }

        $author->update($request_data);

        session()->flash("success", __("site.success_update"));
        return redirect(route("dashboard.authors.index"));
    }

    public function destroy(Author $author)
    {
        $author->delete();
        Storage::disk("public_uploads")->delete("authors/images/$author->image");

        session()->flash("success", __("site.success_delete"));
        return redirect(route("dashboard.authors.index"));
    }
}
