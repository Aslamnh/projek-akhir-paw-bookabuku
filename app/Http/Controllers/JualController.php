<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JualController extends Controller
{
    /**
     * Display a listing of the authenticated user's books.
     */
    public function index()
    {
        // Guest: tampilkan halaman kosong dengan prompt login
        if (!auth()->check()) {
            $books = collect();
            return view('jual', compact('books'));
        }

        $books = auth()->user()->books()->with('orderItems')->orderBy('created_at', 'desc')->get();
        return view('jual', compact('books'));
    }

    /**
     * Store a newly created book listing.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category'    => 'required|string|in:Novel,Komik,Edukasi,Biografi,Teknologi',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = 'book-images/image 89.png'; // default placeholder

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('book-images'), $filename);
            $imagePath = 'book-images/' . $filename;
        }

        auth()->user()->books()->create([
            'title'       => $request->title,
            'author'      => $request->author,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => $imagePath,
            'rating'      => 0.0,
        ]);

        return redirect()->route('jual')->with('success', 'Buku berhasil didaftarkan untuk dijual!');
    }

    /**
     * Update the specified book listing.
     */
    public function update(Request $request, Book $book)
    {
        abort_if($book->user_id !== auth()->id(), 403, 'Anda tidak berhak mengubah buku ini.');

        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category'    => 'required|string|in:Novel,Komik,Edukasi,Biografi,Teknologi',
            'price'       => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $book->image;

        if ($request->hasFile('image')) {
            // Delete old custom image if it exists
            $defaultImages = ['book-images/jual.png', 'book-images/image 89.png', 'book-images/katalog.png', 'book-images/beranda.png'];
            if ($book->image && !in_array($book->image, $defaultImages)) {
                $oldPath = public_path($book->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file      = $request->file('image');
            $filename  = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('book-images'), $filename);
            $imagePath = 'book-images/' . $filename;
        }

        $book->update([
            'title'       => $request->title,
            'author'      => $request->author,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('jual')->with('success', 'Informasi buku berhasil diperbarui!');
    }

    /**
     * Delete the specified book listing.
     */
    public function destroy(Book $book)
    {
        abort_if($book->user_id !== auth()->id(), 403, 'Anda tidak berhak menghapus buku ini.');

        $defaultImages = ['book-images/jual.png', 'book-images/image 89.png', 'book-images/katalog.png', 'book-images/beranda.png'];
        if ($book->image && !in_array($book->image, $defaultImages)) {
            $oldPath = public_path($book->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        $book->delete();

        return redirect()->route('jual')->with('success', 'Buku berhasil dihapus dari listing!');
    }
}
