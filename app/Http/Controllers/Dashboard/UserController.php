<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin','permission:create users'])->only("create");
        $this->middleware(['role:super-admin|admin','permission:read users'])->only("index");
        $this->middleware(['role:super-admin|admin','permission:update users'])->only("edit");
        $this->middleware(['role:super-admin|admin','permission:delete users'])->only("destroy");
    }

    public function index(Request $request)
    {
        $users = User::role("admin")->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');

            });

        })->latest()->paginate(5);

        return view("dashboard.users.index", compact("users"));
    }

    public function create(User $user)
    {
        return view("dashboard.users.create", compact("user"));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            "first_name"    => "required | min:3 | max:10 | string",
            "last_name"     => "required | min:3 | max:10 | string",
            "email"         => "required | email | unique:users,email",
            "image"         => "image",
            "password"      => "required | password | confirmed | min:5 | max:10",
            "permissions"   => "required",
        ]);

        $request_data = $request->except("image", "permissions", "password_confirmation");

        if ($request->image) {

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("upload_files/users/images/" . $request->image->hashName()));

            $request_data["image"] = $request->image->hashName();

        }

        $user = User::create($request_data);

        $user->givePermissionTo($request->permissions);
        $user->assignRole('admin');

        session()->flash("success", __("site.success_create"));
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view("dashboard.users.edit", compact("user"));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "first_name"    => "required | min:3 | max:10 | string",
            "last_name"     => "required | min:3 | max:10 | string",
            "email"         => ["required", Rule::unique('users')->ignore($user->id)],
            "image"         => "image",
            "permissions"   => "required",
        ]);

        $request_data = $request->except(["image", "permissions"]);

        if ($request->image) {

            if($user->image != "default.png") {
                Storage::disk("public_uploads")->delete("users/images/$user->image");
            }

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("upload_files/users/images/" . $request->image->hashName()));

            $request_data["image"] = $request->image->hashName();
        }

        $user->update($request_data);

        $user->syncPermissions($request->permissions);

        session()->flash("success", __("site.success_update"));
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        if($user->image != "default.png") {
            Storage::disk("public_uploads")->delete("users/images/$user->image");
        }

        $user->delete();

        session()->flash("success", __("site.success_delete"));
        return redirect()->route('dashboard.users.index');
    }
}
