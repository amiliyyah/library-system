<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    /**
     * Melihat daftar buku.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'petugas'], true);
    }

    /**
     * Melihat detail satu buku.
     */
    public function view(User $user, Book $book): bool
    {
        return in_array($user->role, ['admin', 'petugas'], true);
    }

    /**
     * Menambah buku (hanya admin).
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Mengubah buku (hanya admin).
     */
    public function update(User $user, Book $book): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Menghapus buku (hanya admin).
     */
    public function delete(User $user, Book $book): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Memulihkan buku (tidak dipakai di proyek ini).
     */
    public function restore(User $user, Book $book): bool
    {
        return false;
    }

    /**
     * Menghapus permanen (tidak dipakai di proyek ini).
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return false;
    }
}