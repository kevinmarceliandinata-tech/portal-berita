@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('content')
<h3>Tambah Pengguna</h3>
<form method="POST" action="{{ route('users.store') }}">
    @include('users._form')
</form>
@endsection