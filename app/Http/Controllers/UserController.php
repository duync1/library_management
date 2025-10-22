<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function getAllBooks(){
        $user = Auth::user();
        $books = Book::where('quantity', '>', 0)->orderBy('created_at', 'desc')->get();
        return view('user.book.show', compact('books', 'user'));
    }

    public function getBorrowHistory(){
        $user = Auth::user();
        $borrowRecords = BorrowRecord::where('user_id', $user->id)->with('book')->orderBy('borrowed_at', 'desc')->get();
        return view('user.borrow-history.show', compact('borrowRecords', 'user'));
    }

    public function borrowBook($id){
        $user = Auth::user();
        $book = Book::findOrFail($id);

        BorrowRecord::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => now()
        ]);

        return redirect('/user/borrow-history')->with('success', 'Book borrowed successfully!');
    }

    public function returnBook($id){
        $user = Auth::user();
        $borrowRecord = BorrowRecord::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        if($borrowRecord->status !== 'borrowed'){
            return redirect('/user/borrow-history')->with('error', 'Only borrowed books can be returned.');
        }

        $borrowRecord->returned_at = now();
        $borrowRecord->status = 'returned';
        $borrowRecord->save();

        $book = Book::findOrFail($borrowRecord->book_id);
        $book->quantity += 1;
        $book->save();

        return redirect('/user/borrow-history')->with('success', 'Book returned successfully!');
    }

    public function cancelBorrow($id){
        $user = Auth::user();
        $borrowRecord = BorrowRecord::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        if($borrowRecord->status === 'approved'){
            return redirect('/user/borrow-history')->with('error', 'Cannot cancel an approved borrow request.');
        }

        $borrowRecord->delete();

        return redirect('/user/borrow-history')->with('success', 'Borrow request cancelled successfully!');
    }

    public function getProfile(){
        $user = Auth::user();
        return view('user.profile.show', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',

            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:6|same:confirm_password',
            'confirm_password' => 'nullable|min:6'
        ], [
            'fullname.required' => 'Full name is required.',
            'new_password.same' => 'New password and confirmation do not match.',
            'current_password.current_password' => 'Current password is incorrect.',
        ]);

        $user->fullname = $validated['fullname'];
        $user->address = $validated['address'] ?? null;
        $user->date_of_birth = $validated['date_of_birth'] ?? null;
        $user->gender = $validated['gender'] ?? null;

        if (!empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return redirect('/user/profile')->with('success', 'Profile updated successfully!');
    }
}
