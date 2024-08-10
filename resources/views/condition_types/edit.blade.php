@extends('layouts.app')

@section('content')
    <h1>Редактировать тип условия</h1>
    <form action="{{ route('condition_types.update', $conditionType) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Код</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $conditionType->code }}" required>
        </div>
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $conditionType->name }}" required>
        </div>

        <div class="mb-3">
            <label for="condition_fields">Поля условий</label>
            <select name="condition_fields[]" id="condition_fields" class="form-control" multiple>
                @foreach($conditionFields as $field)
                    <option value="{{ $field->id }}" {{ in_array($field->id, $conditionType->fields->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $field->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
        <a href="{{ route('condition_types.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection
