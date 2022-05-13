@extends('layouts.master')
@section('title', 'Список файлов')

@section('content')
<body>
<h1>Список файлов</h1>

@foreach($files as $file)
    <div>
        <b>Пользователь:</b> {{ $file->user->name }}
        <b>Файл:</b>
        <a href="{{ route('download', ['file' => $file]) }}">
            {{ $file->name }}
        </a>
        <b>Формат:</b> {{ $file->format }}
        <b>Группа:</b> {{ $file->group->name }}
        <b>Скачиваний:</b> {{ $file->count }}
        <form method="post" action="{{ route('file.destroy', ['file' => $file]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
    </div>
@endforeach
<hr>
@endsection
