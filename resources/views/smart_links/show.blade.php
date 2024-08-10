@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Умная ссылка: {{ $smartLink->slug }}</h1>
        <p><strong>URL по умолчанию:</strong> {{ $smartLink->default_url }}</p>
        <p><strong>Истекает:</strong>
            {{ $smartLink->expires_at ? Carbon\Carbon::parse($smartLink->expires_at)->format('d.m.Y H:i') : 'Не истекает' }}
        </p>
        <p><strong>Создано:</strong> {{ $smartLink->created_at->format('d.m.Y H:i') }}</p>
        <p><strong>Обновлено:</strong> {{ $smartLink->updated_at->format('d.m.Y H:i') }}</p>

        <h2>Правила редиректа</h2>
        @if($smartLink->redirectRules->count() > 0)
            <ul>
                @foreach($smartLink->redirectRules as $rule)
                    <li>
                        <a href="{{$rule->target_url}}">{{$rule->target_url}}</a>
                        <a href="{{ route('redirect_rules.show', $rule->id) }}" class="btn btn-info">Подробнее</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Для этой ссылки еще не создано правил редиректа.</p>
        @endif

        <a href="{{ route('smart_links.edit', $smartLink) }}" class="btn btn-warning">Редактировать</a>
        <a href="{{ route('redirect_rules.index') }}" class="btn btn-secondary">Отмена</a>
        <form action="{{ route('smart_links.destroy', $smartLink) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
        </form>
    </div>
@endsection
