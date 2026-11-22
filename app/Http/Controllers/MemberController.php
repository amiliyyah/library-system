<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'member_code' => 'required|string|max:50|unique:members,member_code',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
        ]);

        Member::create($data);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'member_code' => 'required|string|max:50|unique:members,member_code,' . $member->id,
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string',
        ]);

        $member->update($data);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}