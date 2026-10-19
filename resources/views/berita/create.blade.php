@extends('layouts.app')
@section('content')
<h3>Tambah Berita</h3>
<form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
    @include('berita._form')
</form>
@endsection