<!DOCTYPE html>
<html lang="en">
<head>
    <title>Загрузка файла</title>
</head>
<body>
<h1>Загрузка файла</h1>
<hr>
<form enctype="multipart/form-data" method="post" action="{{ route('upload') }}">

    @csrf

    @include('layouts.errors')

    <p><input type="file" name="file" value="">Выберите файл</p>
    <button type="submit">Загрузить</button>
</form>

<hr>
</body>
</html>
