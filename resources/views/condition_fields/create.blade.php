@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать поле условия</h1>

        <form action="{{ route('condition_fields.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="code">Код</label>
                <input type="text" class="form-control" name="code" id="code" required>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('condition_fields.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
