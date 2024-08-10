@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Поля условий</h1>
        <a href="{{ route('condition_fields.create') }}" class="btn btn-primary">Создать новое поле условия</a>

        <table class="table">
            <thead>
            <tr>
                <th>Название</th>
                <th>Код</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($conditionFields as $field)
                <tr>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->code }}</td>
                    <td>
                        <a href="{{ route('condition_fields.edit', $field->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('condition_fields.destroy', $field->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
