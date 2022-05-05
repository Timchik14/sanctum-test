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
    </div>
@endforeach
<hr>
@endsection
