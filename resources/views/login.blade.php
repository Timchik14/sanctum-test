<!DOCTYPE html>
<html lang="en">
<head>
    <title>Вход</title>
</head>
<body>
<h1>Вход</h1>
<hr>
<form method="post" action="{{ route('login') }}">

    @csrf

    @include('layouts.errors')

    <p><input type="email" name="email" value="{{ old('email') }}"> Почта</p>
    <p><input type="password" name="password" value="{{ old('password') }}"> Пароль</p>
    <button type="submit">Вход</button>
</form>

<hr>
<a href="{{ route('registration-form') }}">Регистрация</a>
</body>
</html>
