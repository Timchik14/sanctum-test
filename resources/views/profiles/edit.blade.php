@extends('layouts.master')
@section('title', 'Редактировать профиль')

@section('content')

    <h1>Редактировать профиль</h1>
    <hr>
    <form method="post" action="{{ route('profiles.show', ['profile' => $profile]) }}">

        @method('PATCH')
        @include('profiles.edit_form')

    </form>
@endsection
