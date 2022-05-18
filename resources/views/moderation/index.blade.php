@extends('layouts.master')
@section('title', 'Модерация')

@section('content')
<h1>Модерация</h1>

@foreach($files as $file)
    @include('files.file')
    <br>
    <form method="post" action="{{ route('moderate', ['file' => $file]) }}">
        @csrf
        <input type="checkbox" id="approved" name="approved" {{ $file->is_approved == true ? 'checked' : '' }}> Проверено
        <button type="submit" class="btn btn-danger">Применить</button>
    </form>
    <br>
@endforeach
<hr>
@endsection
