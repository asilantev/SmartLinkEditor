@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактировать поле условия</h1>

        <form action="{{ route('condition_fields.update', $conditionField->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $conditionField->name }}" required>
            </div>
            <div class="form-group">
                <label for="code">Код</label>
                <input type="text" class="form-control" name="code" id="code" value="{{ $conditionField->code }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection
