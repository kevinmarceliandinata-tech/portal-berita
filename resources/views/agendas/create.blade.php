@extends('layouts.app')
@section('title', 'Tambah Agenda')
@section('content')
<h3>Tambah Agenda</h3>
<form method="POST" action="{{ route('agendas.store') }}">
    @include('agendas._form')
</form>
@endsection