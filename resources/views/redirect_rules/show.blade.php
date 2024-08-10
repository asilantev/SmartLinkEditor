@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Просмотр правила перенаправления</h1>
        <div class="form-group">
            <label>ID</label>
            <p>{{ $redirectRule->id }}</p>
        </div>
        <div class="form-group">
            <label>Умная ссылка</label>
            <div>
                <div class="d-flex align-items-baseline">
                    <p class="mr-2">{{ $redirectRule->smartLink()->first()->slug }}</p>
                    <a href="{{ route('smart_links.show', $redirectRule->smart_link_id) }}" class="btn btn-info">Подробнее</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>URL назначения</label>
            <p>{{ $redirectRule->target_url }}</p>
        </div>
        <div class="form-group">
            <label>Приоритет</label>
            <p>{{ $redirectRule->priority }}</p>
        </div>
        <div class="form-group">
            <label>Активность</label>
            <p>{{ $redirectRule->is_active ? 'Да' : 'Нет' }}</p>
        </div>

        <h2>Условия правила</h2>
        @if($redirectRule->conditions->count() > 0)
            <ul>
                @foreach($redirectRule->conditions as $ruleCondition)
                    <li>
                        <a href="{{ route('rule_conditions.show', $ruleCondition->id) }}">{{ $ruleCondition->conditionType->name }}</a>
{{--                        <a href="{{ route('redirect_rules.show', $rule->id) }}" class="btn btn-info">Подробнее</a>--}}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Для этой ссылки еще не создано правил редиректа.</p>
        @endif
        <div class="mt-3">
            <a href="{{ route('redirect_rules.edit', $redirectRule->id) }}" class="btn btn-warning">Редактировать</a>
            <a href="{{ route('redirect_rules.index') }}" class="btn btn-secondary">Отмена</a>
            <form action="{{ route('redirect_rules.destroy', $redirectRule) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены?')">Удалить</button>
            </form>
        </div>
    </div>
@endsection
