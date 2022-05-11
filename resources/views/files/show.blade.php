@extends('layouts.master')
@section('title', 'Список загрузок')

@section('content')
<body>
<h1>Список загрузок</h1>
<b>Всего: </b> {{ $count }}
<hr>

@foreach($downloads as $download)
    <div>
        <b>Файл:</b> {{ $download->name }}
        <b>Пользователь:</b> {{ $download->user->name }}
        <b>Время:</b> {{ $download->created_at }}
        <b>Группа:</b> {{ $download->group_name }}
    </div>
@endforeach
<hr>
@endsection
