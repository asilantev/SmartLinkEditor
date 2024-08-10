@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Умные ссылки</h1>
        <a href="{{ route('smart_links.create') }}" class="btn btn-primary mb-3">Создать новую ссылку</a>

        <table class="table">
            <thead>
            <tr>
                <th>Slug</th>
                <th>URL по умолчанию</th>
                <th>Истекает</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($smartLinks as $link)
                <tr>
                    <td>{{ $link->slug }}</td>
                    <td>{{ $link->default_url }}</td>
                    <td>{{ $link->expires_at ? $link->expires_at->format('d.m.Y H:i') : 'Не истекает' }}</td>
                    <td>
                        <a href="{{ route('smart_links.show', $link) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <a href="{{ route('smart_links.edit', $link) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('smart_links.destroy', $link) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $smartLinks->links() }}
    </div>
@endsection
