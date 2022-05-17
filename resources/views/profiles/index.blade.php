@extends('layouts.master')
@section('title', 'Профиль')

@section('content')

<h1>Профиль</h1>
<hr>

<p>Имя: {{ auth()->user()->name }}</p>
<p>Email: {{ auth()->user()->email }}</p>
<p>Пол: {{ $user->profile->sex }}</p>
<p>Город: {{ $user->profile->city }}</p>
<p>Возраст: {{ $user->profile->age }}</p>
<hr>
<a href="{{ route('profiles.edit', ['profile' => $user->profile]) }}">Редактировать</a>
@endsection
