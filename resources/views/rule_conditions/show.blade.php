@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Условие</h1>

        <p><strong>ID:</strong> {{ $ruleCondition->id }}</p>
        <p><strong>Правило:</strong> {{ $ruleCondition->rule->name }}</p>
        <p><strong>Тип условия:</strong> {{ $ruleCondition->conditionType->name }}</p>
        <p><strong>Значение:</strong>
        @foreach($ruleCondition->condition_value as $fieldName => $fieldValue)
            @php
                $field = $conditionTypes->where('id', $ruleCondition->condition_type_id)->first()->fields()->where('code', $fieldName)->first();
            @endphp
            @if($field)
                <p>{{ $field->code }}: {{ $fieldValue }}</p>
                @endif
                @endforeach
        </p>

        <a href="{{ route('rule_conditions.edit', $ruleCondition->id) }}" class="btn btn-warning">Редактировать</a>
        <form action="{{ route('rule_conditions.destroy', $ruleCondition->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
@endsection
