<?php

namespace App\Http\Controllers\Dashboard;

use App\Comment;
use App\Book;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin','permission:create comments'])->only("create");
        $this->middleware(['role:super-admin|admin','permission:read comments'])->only("index");
        $this->middleware(['role:super-admin|admin','permission:update comments'])->only("edit");
        $this->middleware(['role:super-admin|admin','permission:delete comments'])->only("destroy");
    }

    public function index(Request $request, Book $book)
    {
        $comments = Comment::whereHas("book", function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where("name", "like", "%" . $request->search . "%");

            });

        })->latest()->paginate(5);
        return view("dashboard.comments.index", compact("comments"));
    }

    public function create()
    {
        $user = auth()->user()->id;
        $books = Book::all();
        return view("dashboard.comments.create", compact("user", "books"));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            "book_id"   => "required",
            "user_id"   => "required",
            "comment"   => "required | string",
            "rating"    => "required | integer",
        ]);

        Comment::create($request->all());

        session()->flash("success", __("site.success_create"));
        return redirect(route("dashboard.comments.index"));
    }

    public function edit(Comment $comment)
    {
        $books = Book::all();
        return view("dashboard.comments.edit", compact("comment", "books"));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            "book_id"   => "required",
            "comment"   => "required | string",
            "rating"    => "required | integer",
        ]);

        $comment->update($request->all());

        session()->flash("success", __("site.success_update"));
        return redirect(route("dashboard.comments.index"));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        session()->flash("success", __("site.success_delete"));
        return redirect(route("dashboard.comments.index"));
    }
}
