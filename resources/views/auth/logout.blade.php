@extends('layouts.master')
@section('title', 'Выход')

@section('content')
<h1>Выход</h1>
<hr>
<form method="post" action="{{ route('logout') }}">

    @csrf

    <button type="submit">Выход</button>

</form>

<hr>
@endsection
