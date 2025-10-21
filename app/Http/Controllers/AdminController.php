<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function getAllBooks(){
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('admin.book.show', compact('books'));
    }

    public function getAllUsers(){
        $users = User::all();
        return view('admin.user.show', compact('users'));
    }

    public function addNewBook(Request $request){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        Book::create($validated);

        return redirect('/admin/books')->with('success', 'Book added successfully!');
    }

    public function updateBook(Request $request, $id){
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_date' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect('/admin/books')->with('success', 'Book updated successfully!');
    }

    public function deleteBook($id){
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/admin/books')->with('success', 'Book deleted successfully!');
    }
}
