@extends('layouts.master')
@section('title', 'Список загрузок')

@section('content')
<body>
<h1>Список загрузок</h1>

@foreach($downloads as $download)
    <div>
        <b>Файл:</b> {{ $download->name }}
        <b>Пользователь:</b> {{ $download->user->name }}
        <b>Время:</b> {{ $download->created_at }}
    </div>
@endforeach
<hr>
@endsection
