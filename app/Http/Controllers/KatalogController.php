<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('sort_field')) {
            $sortDir = $request->input('sort_dir', 'asc');
            $query->orderBy($request->sort_field, $sortDir);
        }

        //temp ga ada category di db
        // if ($request->filled('kategori')) {
        //     $kategoris = explode(',', $request->kategori);
        //     $query->whereIn('category', $kategoris);
        // }

        $books = $query->get();

        if ($request->ajax()) {
            return view('katalog', compact('books'))->fragment('book-grid');
        }

        return view('katalog', compact('books'));
    }

    public function show(Book $book)
    {
        return view('detailbuku', compact('book'));
    }
}
