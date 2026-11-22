<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'anggota') {
            return redirect()->route('portal.borrowings.index');
        }

        $title = 'Library System Dashboard';
        $description = 'Selamat datang di Sistem Informasi Perpustakaan.';

        $totalBooks       = Book::count();
        $totalMembers     = Member::count();
        $totalCategories  = Category::count();
        $totalBorrowings  = Borrowing::count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();

        return view('dashboard.index', compact(
            'title', 'description',
            'totalBooks', 'totalMembers', 'totalCategories',
            'totalBorrowings', 'activeBorrowings'
        ));
    }
}