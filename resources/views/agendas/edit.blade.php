@extends('layouts.app')
@section('title', 'Edit Agenda')
@section('content')
<h3>Edit Agenda</h3>
<form method="POST" action="{{ route('agendas.update', $agenda) }}">
    @method('PUT')
    @include('agendas._form')
</form>
@endsection