<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use App\Models\RecentlyViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(12);

        $topRated = Book::whereNotNull('rating')
            ->orderByDesc('rating')
            ->limit(5)
            ->get();

        $recentlyViewed = collect();
        $userRatings    = [];

        if (Auth::check()) {
            $recentlyViewed = RecentlyViewed::with('book')
                ->where('user_id', Auth::id())
                ->latest()
                ->limit(5)
                ->get()
                ->pluck('book')
                ->filter();

            $userRatings = Rating::where('user_id', Auth::id())
                ->pluck('rating', 'book_id')
                ->toArray();
        }

        return view('beranda', compact('books', 'topRated', 'recentlyViewed', 'userRatings'));
    }

    public function rate(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        Rating::updateOrCreate(
            ['user_id' => Auth::id(), 'book_id' => $book->id],
            ['rating'  => $request->rating]
        );

        $average = round($book->ratings()->avg('rating'), 2);
        $book->update(['rating' => $average]);

        $topRated = Book::whereNotNull('rating')
            ->orderByDesc('rating')
            ->limit(5)
            ->get(['id', 'title', 'author', 'image', 'rating'])
            ->map(fn($b) => [
                'id'     => $b->id,
                'title'  => $b->title,
                'author' => $b->author,
                'image'  => $b->image,
                'rating' => $b->rating,
            ]);

        return response()->json([
            'success'     => true,
            'new_average' => $average,
            'top_rated'   => $topRated,
        ]);
    }
}