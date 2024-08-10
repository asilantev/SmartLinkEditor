@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать новое условие</h1>

        <form action="{{ route('rule_conditions.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rule_id">Правило</label>
                <select name="rule_id" id="rule_id" class="form-control">
                    <option selected disabled>Выберите правило</option>
                    @foreach($rules as $rule)
                        <option value="{{ $rule->id }}">{{ $rule->target_url }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="condition_type_id">Тип условия</label>
                <select name="condition_type_id" id="condition_type_id" class="form-control">
                    <option selected disabled>Выберите тип условия</option>
                    @foreach($conditionTypes as $conditionType)
                        <option value="{{ $conditionType->id }}">{{ $conditionType->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="field_values_container"></div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('rule_conditions.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>

    <script>
        document.getElementById('condition_type_id').addEventListener('change', function () {
            let selectedTypeId = this.value;
            let fieldValuesContainer = document.getElementById('field_values_container');
            fieldValuesContainer.innerHTML = '';

            if (selectedTypeId) {
                let conditionTypes = @json($conditionTypes);

                let selectedType = conditionTypes.find(type => type.id == selectedTypeId);
                if (selectedType && selectedType.fields) {
                    selectedType.fields.forEach(field => {
                        let fieldElement = document.createElement('div');
                        fieldElement.classList.add('form-group');
                        fieldElement.innerHTML = `
                            <label for="${field.code}">${field.name}</label>
                            <input name="condition_value[${field.code}]" id="${field.code}" class="form-control" required>
                        `;
                        fieldValuesContainer.appendChild(fieldElement);
                    });
                }
            }
        });
    </script>
@endsection
