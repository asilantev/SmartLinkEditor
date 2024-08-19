@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Редактирование условия</h1>

        <form action="{{ route('rule_conditions.update', $ruleCondition->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="rule_id">Правило</label>
                <select name="rule_id" id="rule_id" class="form-control">
                    @foreach($rules as $rule)
                        <option value="{{ $rule->id }}" {{ $ruleCondition->rule_id == $rule->id ? 'selected' : '' }}>{{ $rule->target_url }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="condition_type_id">Тип условия</label>
                <select name="condition_type_id" id="condition_type_id" class="form-control">
                    @foreach($conditionTypes as $conditionType)
                        <option value="{{ $conditionType->id }}" {{ $ruleCondition->condition_type_id == $conditionType->id ? 'selected' : '' }}>{{ $conditionType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="field_values_container"></div>
            @foreach($ruleCondition->condition_value as $fieldName => $fieldValue)
                @php
                    $field = $conditionTypes->where('id', $ruleCondition->condition_type_id)->first()->fields()->where('name', $fieldName)->first();
                @endphp
                @if($field)
                    <div class="form-group">
                        <label for="{{ $fieldName }}">{{ $field->code }}</label>
                        <input type="text" name="condition_value[{{ $fieldName }}]" id="{{ $fieldName }}" class="form-control" value="{{ old('condition_value.'.$fieldName, $fieldValue) }}">
                    </div>
                @endif
            @endforeach

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <script>
        document.getElementById('condition_type_id').addEventListener('change', function () {
            updateFieldValues();
        });

        function updateFieldValues() {
            let selectedTypeId = document.getElementById('condition_type_id').value;
            let fieldValuesContainer = document.getElementById('field_values_container');
            fieldValuesContainer.innerHTML = '';

            if (selectedTypeId) {
                let conditionTypes = @json($conditionTypes);
                let conditionFieldValues = @json($ruleCondition->condition_value);

                let selectedType = conditionTypes.find(type => type.id == selectedTypeId);
                if (selectedType && selectedType.fields) {
                    selectedType.fields.forEach(field => {
                        let fieldValue = conditionFieldValues ? conditionFieldValues[field.code] : '';
                        let fieldElement = document.createElement('div');
                        fieldElement.classList.add('form-group');
                        fieldElement.innerHTML = `
                            <label for="${field.code}">${field.name}</label>
                            <input name="condition_value[${field.code}]" id="${field.code}" class="form-control" value="${fieldValue}" required>
                        `;
                        fieldValuesContainer.appendChild(fieldElement);
                    });
                }
            }
        }

        // Initial call to populate fields on page load
        updateFieldValues();
    </script>
@endsection
