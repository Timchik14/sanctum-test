@extends('layouts.master')
@section('title', 'Личный кабинет')

@section('content')

<h1>Личный кабинет</h1>
<ul>
    <li>
        <a href="{{ route('profiles.show', ['profile' => auth()->id()]) }}">Профиль</a>
    </li>
</ul>

<hr>
@endsection
