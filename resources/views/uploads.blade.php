@extends('layouts.master')
@section('title', 'Загрузка файлов')

@section('content')
<h1>Загрузка файла</h1>
<hr>
<form enctype="multipart/form-data" method="post" action="{{ route('upload') }}">

    @csrf

    @include('layouts.errors')

    <p><input type="file" name="files[]" multiple>Выберите файл</p>

    @include('groups.index')

    <button type="submit">Загрузить</button>

</form>

<hr>
@endsection
