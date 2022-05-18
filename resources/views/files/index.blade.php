@extends('layouts.master')
@section('title', 'Список файлов')

@section('content')
<h1>Список файлов</h1>

@foreach($files as $file)
    @include('files.file')
    <form method="post" action="{{ route('file.destroy', ['file' => $file]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>
    <br>
@endforeach
<hr>
@endsection
