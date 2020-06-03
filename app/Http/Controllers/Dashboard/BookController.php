<?php

namespace App\Http\Controllers\Dashboard;

use App\Book;
use App\Author;
use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|admin','permission:create books'])->only("create");
        $this->middleware(['role:super-admin|admin','permission:read books'])->only("index");
        $this->middleware(['role:super-admin|admin','permission:update books'])->only("edit");
        $this->middleware(['role:super-admin|admin','permission:delete books'])->only("destroy");
    }

    public function index(Request $request, Comment $comment, Book $book)
    {
        $books = Book::with("author", "category")->when($request->search, function ($q) use ($request) {

            return $q->where("name", "like", "%" . $request->search . "%");

        })->latest()->paginate(5);

        return view("dashboard.books.index", compact("books"));
    }

    public function create()
    {
        $authors    = Author::all();
        $categories = Category::all();

        return view("dashboard.books.create", compact("authors", "categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"          => "required | string",
            "author_id"     => "required",
            "category_id"   => "required",
            "image_book"    => "required | image",
            "desc"          => "required | string | min:50",
            "lang"          => "required | string",
            "file_book"     => "required | file | mimes:pdf,doc",
        ]);

        $request_date = $request->except(["image_book", "file_book"]);

        if($request->image_book) {

            Image::make($request->image_book)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("upload_files/books/images/" . $request->image_book->hashName()));

            $request_date["image_book"] = $request->image_book->hashName();
        }

        if ($request->file('file_book')) {
            $request->file('file_book')->store('books/files', "public_uploads");
            $request_date["file_book"] = $request->file_book->hashName();
        }

        Book::create($request_date);

        session()->flash("success", __("site.success_create"));
        return redirect()->route('dashboard.books.index');
    }

    public function edit(Author $author, Category $category, Book $book)
    {
        $authors    = Author::all();
        $categories = Category::all();
        $book       = Book::all()->first();

        return view("dashboard.books.edit", compact("authors", "categories", "book"));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            "name"          => "required | string",
            "author_id"     => "required",
            "category_id"   => "required",
            "image_book"    => "image",
            "desc"          => "required | string | min:50",
            "lang"          => "required | string",
            "file_book"     => "file | mimes:pdf,doc",
        ]);

        $request_date = $request->except(["image_book", "file_book"]);

        if($request->image_book !== null) {

            Storage::disk("public_uploads")->delete("books/images/$book->image_book");

            Image::make($request->image_book)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path("upload_files/books/images/" . $request->image_book->hashName()));

            $request_date["image_book"] = $request->image_book->hashName();
        }

        if($request->file_book !== null) {

            Storage::disk("public_uploads")->delete("books/files/$book->file_book");

            $request->file('file_book')->store('books/files', "public_uploads");
            $request_date["file_book"] = $request->file_book->hashName();
        }

        $book->update($request_date);

        session()->flash("success", __("site.success_update"));
        return redirect()->route('dashboard.books.index');
    }

    public function destroy(Book $book, Comment $comment)
    {
        Storage::disk("public_uploads")->delete("books/images/$book->image_book");
        Storage::disk("public_uploads")->delete("books/files/$book->file_book");

        $book->delete();

        session()->flash("success", __("site.success_delete"));
        return redirect()->route('dashboard.books.index');
    }
}
