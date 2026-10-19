@extends('layouts.app')
@section('title', 'Edit Pengguna')
@section('content')
<h3>Edit Pengguna</h3>
<form method="POST" action="{{ route('users.update', $user) }}">
    @method('PUT')
    @include('users._form')
</form>
@endsection