<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getBorrowRecords(){
        $borrowRecords = BorrowRecord::orderBy('borrowed_at', 'desc')->get();
        return view('admin.borrow-record.show', compact('borrowRecords'));
    }

    public function approveBorrowRequest($id){
        $record = BorrowRecord::findOrFail($id);
        $book = Book::findOrFail($record->book_id);
        $book->quantity -= 1;
        $book->save();
        $record->status = 'borrowed';
        $record->save();

        return redirect('/admin/borrow-records')->with('success', 'Borrow request approved!');
    }

    public function finalizeBorrowRequest($id){
        $record = BorrowRecord::findOrFail($id);
        $record->status = 'finalized';
        $record->save();

        return redirect('/admin/borrow-records')->with('success', 'Borrow request finalized!');
    }

    public function returnBook($id)
    {
        $borrowRecord = BorrowRecord::findOrFail($id);

        if ($borrowRecord->status !== 'borrowed') {
            return redirect('/admin/borrow-records')->with('error', 'Only borrowed books can be returned.');
        }

        $borrowRecord->returned_at = now();
        $borrowRecord->status = 'returned';
        $borrowRecord->save();

        $book = Book::findOrFail($borrowRecord->book_id);
        $book->quantity += 1;
        $book->save();

        return redirect('/admin/borrow-records')->with('success', 'Book returned successfully!');
    }

    public function getBorrowDetails($userId){
        $borrowRecords = BorrowRecord::where('user_id', $userId)->orderBy('borrowed_at', 'desc')->get();
        return view('admin.borrow-record.detail', compact('borrowRecords', 'userId'));
    }
}
