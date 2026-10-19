@extends('layouts.app')
@section('title', 'Edit Pengumuman')
@section('content')
<h3>Edit Pengumuman</h3>
<form method="POST" action="{{ route('pengumumans.update', $pengumuman) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('pengumumans._form')
</form>
@endsection