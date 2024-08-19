@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Условия</h1>

        <a href="{{ route('rule_conditions.create') }}" class="btn btn-primary mb-3">Создать новое условие</a>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Правило</th>
                <th>Тип условия</th>
                <th>Значение</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ruleConditions as $ruleCondition)
                <tr>
                    <td>{{ $ruleCondition->id }}</td>
                    <td>{{ $ruleCondition->rule->target_url }}</td>
                    <td>{{ $ruleCondition->conditionType->name }}</td>
                    <td>
                        @foreach($ruleCondition->condition_value as $fieldName => $fieldValue)
                            @php
                                $field = $conditionTypes->where('id', $ruleCondition->condition_type_id)->first()->fields()->where('code', $fieldName)->first();
                            @endphp
                            @if($field)
                                <p>{{ $field->code }}: {{ $fieldValue }}</p>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('rule_conditions.show', $ruleCondition) }}" class="btn btn-sm btn-info">Просмотр</a>
                        <a href="{{ route('rule_conditions.edit', $ruleCondition->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('rule_conditions.destroy', $ruleCondition->id) }}" method="POST" style="display:inline;">
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
