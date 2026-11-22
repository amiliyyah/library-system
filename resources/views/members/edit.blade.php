@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
<h3>Edit Anggota</h3>
<form action="{{ route('members.update', $member) }}" method="POST">
    @csrf @method('PUT')
    @include('members._form')
</form>
@endsection