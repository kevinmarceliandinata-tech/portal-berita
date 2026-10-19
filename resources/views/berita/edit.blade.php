@extends('layouts.app')
@section('content')
<h3>Edit Berita</h3>
<form method="POST" action="{{ route('berita.update', $berita) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('berita._form')
</form>
@endsection