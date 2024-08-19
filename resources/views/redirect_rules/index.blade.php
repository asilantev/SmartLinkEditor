@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список правил перенаправления</h1>
        <a href="{{ route('redirect_rules.create') }}" class="btn btn-primary">Создать новое правило</a>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>ID</th>
                <th>Умная ссылка</th>
                <th>URL назначения</th>
                <th>Приоритет</th>
                <th>Активность</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rules as $rule)
                <tr>
                    <td>{{ $rule->id }}</td>
                    <td>{{ $rule->smart_link_id }}</td>
                    <td>{{ $rule->target_url }}</td>
                    <td>{{ $rule->priority }}</td>
                    <td>{{ $rule->is_active ? 'Да' : 'Нет' }}</td>
                    <td>
                        <a href="{{ route('redirect_rules.show', $rule->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <a href="{{ route('redirect_rules.edit', $rule->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('redirect_rules.destroy', $rule->id) }}" method="POST" style="display:inline;">
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
