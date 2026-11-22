<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MemberPortalController extends Controller
{
    private function member(): Member
    {
        $member = auth()->user()->member;
        abort_if(! $member, 403, 'Akun ini belum terhubung dengan data anggota.');

        return $member;
    }

    public function index()
    {
        $borrowings = $this->member()->borrowings()
            ->with('details.book')
            ->latest()
            ->paginate(10);

        return view('portal.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('portal.create', compact('books'));
    }

    public function store(Request $request)
    {
        $member = $this->member();

        $request->validate([
            'books'            => 'required|array|min:1',
            'books.*.book_id'  => 'required|exists:books,id|distinct',
            'books.*.quantity' => 'required|integer|min:1',
        ], [
            'books.required'           => 'Pilih minimal satu buku.',
            'books.*.book_id.required' => 'Buku harus dipilih.',
            'books.*.book_id.distinct' => 'Buku yang sama tidak boleh dipilih dua kali.',
        ]);

        DB::transaction(function () use ($request, $member) {
            $borrowing = Borrowing::create([
                'user_id'        => auth()->id(),
                'member_id'      => $member->id,
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

        return redirect()->route('portal.borrowings.index')
            ->with('success', 'Peminjaman berhasil. Batas pengembalian 7 hari.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        abort_unless($borrowing->member_id === $this->member()->id, 403);

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

        return redirect()->route('portal.borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan. Terima kasih.');
    }
}