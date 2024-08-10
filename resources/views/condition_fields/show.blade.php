@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $conditionField->name }}</h1>
        <p>Код: {{ $conditionField->code }}</p>
        <a href="{{ route('condition_fields.index') }}" class="btn btn-secondary">Назад</a>
    </div>
@endsection
