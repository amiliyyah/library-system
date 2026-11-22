<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])
            ->latest()
            ->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $books   = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id'        => 'required|exists:members,id',
            'books'            => 'required|array|min:1',
            'books.*.book_id'  => 'required|exists:books,id|distinct',
            'books.*.quantity' => 'required|integer|min:1',
        ], [
            'member_id.required'       => 'Anggota harus dipilih.',
            'books.required'           => 'Pilih minimal satu buku.',
            'books.*.book_id.required' => 'Buku harus dipilih.',
            'books.*.book_id.distinct' => 'Buku yang sama tidak boleh dipilih dua kali.',
        ]);

        DB::transaction(function () use ($request) {
            $borrowing = Borrowing::create([
                'user_id'        => auth()->id(),
                'member_id'      => $request->member_id,
                'borrowing_date' => now()->toDateString(),
                'due_date'       => now()->addDays(7)->toDateString(),
                'status'         => 'borrowed',
            ]);

            foreach ($request->books as $item) {
                $book = Book::lockForUpdate()->findOrFail($item['book_id']);

                if ($book->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'books' => "Stok buku \"{$book->title}\" tidak mencukupi (sisa {$book->stock}).",
                    ]);
                }

                $borrowing->details()->create([
                    'book_id'  => $book->id,
                    'quantity' => $item['quantity'],
                ]);

                $book->decrement('stock', $item['quantity']);
            }
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Transaksi peminjaman berhasil disimpan.');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'user', 'details.book']);

        return view('borrowings.show', compact('borrowing'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'returned') {
            return back()->withErrors(['status' => 'Buku sudah dikembalikan.']);
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->update([
                'return_date' => now()->toDateString(),
                'status'      => 'returned',
            ]);

            foreach ($borrowing->details as $detail) {
                $detail->book->increment('stock', $detail->quantity);
            }
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan, stok diperbarui.');
    }
}