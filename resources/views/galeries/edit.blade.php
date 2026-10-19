@extends('layouts.app')
@section('title', 'Edit Foto')
@section('content')
<h3>Edit Foto</h3>
<form method="POST" action="{{ route('galeries.update', $galery) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('galeries._form')
</form>
@endsection