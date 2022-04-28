<!DOCTYPE html>
<html lang="en">
<head>
    <title>Регистрация</title>
</head>
<body>
<h1>Регистрация</h1>
<hr>

<form method="post" action="{{ route('register') }}">

    @csrf

    @include('layouts.errors')

    <p><input type="text" name="name" value="{{ old('name') }}"> Имя</p>
    <p><input type="email" name="email" value="{{ old('email') }}"> Почта</p>
    <p><input type="password" name="password" value="{{ old('password') }}"> Пароль</p>
    <button type="submit">Регистрация</button>
</form>

<hr>

</body>
</html>
