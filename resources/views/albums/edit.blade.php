@extends('layouts.app')
@section('title', 'Edit Album')
@section('content')
<h3>Edit Album</h3>
<form method="POST" action="{{ route('albums.update', $album) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('albums._form')
</form>
@endsection