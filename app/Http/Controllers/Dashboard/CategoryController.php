<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin','permission:create categories'])->only("create");
        $this->middleware(['role:super-admin|admin','permission:read categories'])->only("index");
        $this->middleware(['role:super-admin|admin','permission:update categories'])->only("edit");
        $this->middleware(['role:super-admin|admin','permission:delete categories'])->only("destroy");
    }

    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->where("name", "like", "%" . $request->search . "%");

        })->latest()->paginate(5);
        return view("dashboard.categories.index", compact("categories"));
    }

    public function create(Category $category)
    {
        return view("dashboard.categories.create", compact("category"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required | string | unique:categories"
        ]);

        Category::create($request->all());

        session()->flash("success", __("site.success_create"));
        return redirect(route("dashboard.categories.index"));
    }

    public function edit(Category $category)
    {
        return view("dashboard.categories.edit", compact("category"));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => ["required", Rule::unique("categories")->ignore($category->id)]
        ]);

        $category->update($request->all());

        session()->flash("success", __("site.success_update"));
        return redirect(route("dashboard.categories.index"));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash("success", __("site.success_delete"));
        return redirect(route("dashboard.categories.index"));
    }
}
