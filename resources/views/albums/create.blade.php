@extends('layouts.app')
@section('title', 'Tambah Album')
@section('content')
<h3>Tambah Album</h3>
<form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
    @include('albums._form')
</form>
@endsection