@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать правило редиректа</h1>
        <form action="{{ route('redirect_rules.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="smart_link_id">Умная ссылка</label>
                <select name="smart_link_id" id="smart_link_id" class="form-control">
                    @foreach($smartLinks as $smartLink)
                        <option value="{{ $smartLink->id }}">{{ $smartLink->slug }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="target_url">URL назначения</label>
                <input type="url" name="target_url" id="target_url" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="priority">Приоритет</label>
                <input type="number" name="priority" id="priority" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="is_active">Активность</label>
                <select name="is_active" id="is_active" class="form-control" required>
                    <option value="1">Да</option>
                    <option value="0">Нет</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('redirect_rules.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
