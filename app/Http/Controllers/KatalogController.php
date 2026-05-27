<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

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

        $books = $query->get();

        if ($request->filled('kategori')) {
            $kategoris = explode(',', strtolower($request->kategori));
            $books = $books->filter(function ($book) use ($kategoris) {
                $bookCat = strtolower($book->category ?? 'novel');
                return in_array($bookCat, $kategoris);
            });
        }

        if ($request->ajax()) {
            return view('katalog', compact('books'))->fragment('book-grid');
        }

        return view('katalog', compact('books'));
    }
}
