@extends('layouts.app')

@section('content')
    <h1>Типы условий</h1>
    <a href="{{ route('condition_types.create') }}" class="btn btn-primary">Создать новый тип условия</a>

    <table class="table mt-3">
        <thead>
        <tr>
            <th>Код</th>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conditionTypes as $conditionType)
            <tr>
                <td>{{ $conditionType->code }}</td>
                <td>{{ $conditionType->name }}</td>
                <td>
                    <a href="{{ route('condition_types.edit', $conditionType) }}" class="btn btn-sm btn-warning">Редактировать</a>
                    <form action="{{ route('condition_types.destroy', $conditionType) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
