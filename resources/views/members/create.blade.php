@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<h3>Tambah Anggota</h3>
<form action="{{ route('members.store') }}" method="POST">
    @csrf
    @include('members._form')
</form>
@endsection