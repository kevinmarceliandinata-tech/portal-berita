@extends('layouts.app')
@section('title', 'Tambah Pengumuman')
@section('content')
<h3>Tambah Pengumuman</h3>
<form method="POST" action="{{ route('pengumumans.store') }}" enctype="multipart/form-data">
    @include('pengumumans._form')
</form>
@endsection