@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Создать умную ссылку</h1>
        <form action="{{ route('smart_links.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="form-group">
                <label for="default_url">URL по умолчанию</label>
                <input type="url" class="form-control" id="default_url" name="default_url" required>
            </div>
            <div class="form-group">
                <label for="expires_at">Дата истечения (необязательно)</label>
                <input type="datetime-local" class="form-control" id="expires_at" name="expires_at">
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('smart_links.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
@endsection
