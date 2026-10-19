@extends('layouts.app')
@section('title', 'Tambah Foto')
@section('content')
<h3>Tambah Foto</h3>
<form method="POST" action="{{ route('galeries.store') }}" enctype="multipart/form-data">
    @include('galeries._form')
</form>
@endsection